<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\PublicationType;
use App\Models\Cost;
use App\Models\NewsPaperType;
use App\Models\Language;
use App\Models\Department;
use App\Models\PrintType;
use App\Models\BannerSize;
use App\Models\Advertise;
use App\Models\AdvertiseNewsPaper;
use App\Models\FinancialYear;
use App\Models\NewsPaper;
use App\Models\Signature;
use PDF;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertises = Advertise::with([
            'publicationType', 'cost', 'department', 'printType', 'bannerSize'
        ])->where('is_mail_send', 0)->latest()->get();

        return view('advertise.index')->with([
            'advertises' => $advertises
        ]);
    }

    public function sendMail(){
        $advertises = Advertise::with([
            'publicationType', 'cost', 'department', 'printType', 'bannerSize'
        ])->where('is_mail_send', 1)->latest()->get();

        return view('advertise.send-mail')->with([
            'advertises' => $advertises
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $publicationTypes = PublicationType::latest()->get();

        $costs = Cost::latest()->get();

        $newsPaperTypes = NewsPaperType::latest()->get();

        $languages = Language::latest()->get();

        $departments = Department::latest()->get();

        $printTypes = PrintType::latest()->get();

        $bannerSizes = BannerSize::latest()->get();

        return view('advertise.create')->with([
            'publicationTypes' => $publicationTypes,
            'newsPaperTypes' => $newsPaperTypes,
            'languages' => $languages,
            'departments' => $departments,
            'printTypes' => $printTypes,
            'costs' => $costs,
            'bannerSizes' => $bannerSizes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            DB::beginTransaction();
            $sequenceNo = FinancialYear::where('is_active', 1)->value('sequence');
            DB::table('financial_years')->where('is_active', 1)->update([
                'sequence' => $sequenceNo+1
            ]);

            $advertise = new Advertise;
            $advertise->publication_type_id = $request->publication_type_id;
            if(isset($request->is_jahir_nivida)){
                $advertise->cost_id = $request->cost_id ?? null;
            }
            $advertise->department_id = $request->department_id;
            $advertise->print_type_id = $request->print_type_id;
            $advertise->banner_size_id = $request->banner_size_id;
            $advertise->unique_number = $sequenceNo;
            $advertise->publication_date = date('Y-m-d', strtotime($request->publication_date));
            $advertise->work_order_number = $request->work_order_number;
            if($request->hasFile('image')){
                $advertise->image = $request->image->store('advertise');
            }

            if($advertise->save()){
                $newsPaperId = []; //array to store news paper id
                if(isset($request->is_jahir_nivida)){
                    if(isset($request->jahir_news_paper_type_id) && count($request->jahir_news_paper_type_id) > 0){
                        for($i=0; $i < count($request->jahir_news_paper_type_id); $i++){
                            if($request->jahir_news_paper_type_id[$i] != ""){
                                $advertiseNew = new AdvertiseNewsPaper;
                                $advertiseNew->advertise_id = $advertise->id;
                                $advertiseNew->news_paper_id = $request->jahir_news_paper_type_id[$i];
                                $advertiseNew->save();

                                $newsPaperId[] = $request->jahir_news_paper_type_id[$i];
                            }
                        }
                    }
                }else{
                    if(isset($request->not_jahir_news_paper_id) && count($request->not_jahir_news_paper_id) > 0){
                        for($i=0; $i < count($request->not_jahir_news_paper_id); $i++){
                            if($request->not_jahir_news_paper_id[$i] != ""){
                                $advertiseNew = new AdvertiseNewsPaper;
                                $advertiseNew->advertise_id = $advertise->id;
                                $advertiseNew->news_paper_id = $request->not_jahir_news_paper_id[$i];
                                $advertiseNew->save();

                                $newsPaperId[] = $request->not_jahir_news_paper_id[$i];
                            }
                        }
                    }
                }
                $this->updateNewsPaperSelectedtime($newsPaperId);
                $this->generatePdf($advertise);
            }

            DB::commit();

            return redirect()->route('send-mail.index', $advertise->id);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }
    }

    public function edit($id){
        $advertise = Advertise::with(['advertiseNewsPapers' => function($query){
            $query->with(['newsPaper.newsPaperType', 'newsPaper.language']);
        }])->where('id', $id)->first();

        if($advertise->is_mail_send){
            return redirect()->route('advertise.index');
        }
        $publicationTypes = PublicationType::latest()->get();

        $costs = Cost::latest()->get();

        $newsPaperTypes = NewsPaperType::latest()->get();

        $languages = Language::latest()->get();

        $departments = Department::latest()->get();

        $printTypes = PrintType::latest()->get();

        $bannerSizes = BannerSize::latest()->get();

        $jahorNividaNewsPaperTypeDatas = [];
        $notJahorNividaNewsPaperTypeDatas = [];
        if($advertise->cost_id && $advertise->cost_id != ""){
            $jahorNividaNewsPaperTypeDatas = NewsPaperType::withWhereHas('advertiseCost', function($q) use($advertise){
                $q->where('cost_id', $advertise->cost_id)
                  ->with('language', function($lang){
                        $lang->select('id', 'name')
                             ->with('newsPapers', function($newsPaper){
                                $newsPaper->orderBy('selected_datetime', 'asc');
                             });
                  });
            })->latest()->get();
        }else{
            $languageIds = NewsPaper::whereHas('advertiseNewsPaper', function($q) use($advertise){
                $q->where('advertise_id', $advertise->id);
            })->pluck('language_id');

            $newsPaperTypesIds = NewsPaper::whereHas('advertiseNewsPaper', function($q) use($advertise){
                $q->where('advertise_id', $advertise->id);
            })->pluck('news_paper_type_id');
            // return $advertise;
            $newsPaperTypesDatas = NewsPaperType::whereIn('id', $newsPaperTypesIds)->latest()->get();

            $notJahorNividaNewsPaperTypeDatas = [];
            foreach( $newsPaperTypesDatas as $newsPaperType ){
                $id = $newsPaperType->id;
                $notJahorNividaNewsPaperTypeDatas[] = [
                    'id' => $newsPaperType->id,
                    'name' => $newsPaperType->name,
                    'language' => Language::withWhereHas('newsPapers', function($query) use($id){
                        $query->where('news_paper_type_id', $id);
                    })->whereIn('id', $languageIds)->get()
                ];
            }
        }
        // return $notJahorNividaNewsPaperTypeDatas;
        return view('advertise.edit')->with([
            'publicationTypes' => $publicationTypes,
            'newsPaperTypes' => $newsPaperTypes,
            'languages' => $languages,
            'departments' => $departments,
            'printTypes' => $printTypes,
            'costs' => $costs,
            'bannerSizes' => $bannerSizes,
            'advertise' => $advertise,
            'jahorNividaNewsPaperTypeDatas' => $jahorNividaNewsPaperTypeDatas,
            'notJahorNividaNewsPaperTypeDatas' => $notJahorNividaNewsPaperTypeDatas
        ]);
    }

    public function update(Request $request){
        try
        {
            DB::beginTransaction();

            $advertise = Advertise::find($request->id);
            $advertise->publication_type_id = $request->publication_type_id;
            if(isset($request->is_jahir_nivida)){
                $advertise->cost_id = $request->cost_id ?? null;
            }else{
                $advertise->cost_id = null;
            }
            $advertise->department_id = $request->department_id;
            $advertise->print_type_id = $request->print_type_id;
            $advertise->banner_size_id = $request->banner_size_id;
            $advertise->publication_date = date('Y-m-d', strtotime($request->publication_date));
            $advertise->work_order_number = $request->work_order_number;
            if($request->hasFile('image')){
                if (Storage::exists($advertise->image)){
                    Storage::delete($advertise->image);
                }
                $advertise->image = $request->image->store('advertise');
            }

            if($advertise->save()){
                $newsPaperId = [];
                DB::table('advertise_news_papers')->where('advertise_id', $advertise->id)->delete();
                if(isset($request->is_jahir_nivida)){
                    if(isset($request->jahir_news_paper_type_id) && count($request->jahir_news_paper_type_id) > 0){
                        for($i=0; $i < count($request->jahir_news_paper_type_id); $i++){
                            if($request->jahir_news_paper_type_id[$i] != ""){
                                $advertiseNew = new AdvertiseNewsPaper;
                                $advertiseNew->advertise_id = $advertise->id;
                                $advertiseNew->news_paper_id = $request->jahir_news_paper_type_id[$i];
                                $advertiseNew->save();

                                $newsPaperId[] = $request->jahir_news_paper_type_id[$i];
                            }
                        }
                    }
                }else{
                    if(isset($request->not_jahir_news_paper_id) && count($request->not_jahir_news_paper_id) > 0){
                        for($i=0; $i < count($request->not_jahir_news_paper_id); $i++){
                            if($request->not_jahir_news_paper_id[$i] != ""){
                                $advertiseNew = new AdvertiseNewsPaper;
                                $advertiseNew->advertise_id = $advertise->id;
                                $advertiseNew->news_paper_id = $request->not_jahir_news_paper_id[$i];
                                $advertiseNew->save();

                                $newsPaperId[] = $request->not_jahir_news_paper_id[$i];
                            }
                        }
                    }
                }
                if (Storage::exists($advertise->generate_pdf_url)){
                    Storage::delete($advertise->generate_pdf_url);
                }

                $this->updateNewsPaperSelectedtime($newsPaperId);
                $this->generatePdf($advertise);
            }

            DB::commit();

            return redirect()->route('send-mail.index', $advertise->id);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }
    }


    public function generatePdf($advertise){
        $advertise = Advertise::with(['department', 'printType', 'publicationType', 'bannerSize', 'advertiseNewsPapers.newsPaper'])->where('id', $advertise->id)->first();

        $signature = Signature::value('name');

        $pdf = PDF::loadView('advertise.pdf', compact('advertise', 'signature'));

        $name = 'pdf/'.'advertise-'.time().'.pdf';

        Storage::put($name, $pdf->output());

        DB::table('advertises')->where('id', $advertise->id)->update(['generate_pdf_url' => $name]);
    }

    public function updateNewsPaperSelectedtime($newsPaperId){
        DB::table('news_papers')->whereIn('id', $newsPaperId)->update([
            'selected_datetime' => now()
        ]);
    }

    public function preview(Request $request){
        $advertise = Advertise::with(['department', 'publicationType', 'printType', 'bannerSize'])->find($request->id);

        $newsPaperId = AdvertiseNewsPaper::where('advertise_id', $request->id)->pluck('news_paper_id');

        $newsPapers = NewsPaper::whereHas('advertiseNewsPaper', function($query) use($newsPaperId){
            $query->whereIn('news_paper_id', $newsPaperId);
        })->get();

        return view('advertise.preview')->with([
            'newsPapers' => $newsPapers,
            'advertise' => $advertise
        ]);
    }

}
