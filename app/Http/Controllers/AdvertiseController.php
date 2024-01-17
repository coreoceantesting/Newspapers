<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\PublicationType;
use App\Models\AdvertiseCost;
use App\Models\Cost;
use App\Models\NewsPaperType;
use App\Models\Language;
use App\Models\Department;
use App\Models\PrintType;
use App\Models\BannerSize;
use App\Models\Advertise;
use App\Models\AdvertiseNewsPaper;
use App\Models\FinancialYear;
use Barryvdh\Snappy\Facades\SnappyPdf;

class AdvertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertises = Advertise::with([
            'publicationType', 'cost', 'department', 'printType', 'bannerSize'
        ])->get();

        return view('advertise.index')->with([
            'advertises' => $advertises
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $publicationTypes = PublicationType::latest()->get();

        $advertiseCosts = AdvertiseCost::latest()->get();

        $costs = Cost::latest()->get();

        $newsPaperTypes = NewsPaperType::latest()->get();

        $languages = Language::latest()->get();

        $departments = Department::latest()->get();

        $printTypes = PrintType::latest()->get();

        $bannerSizes = BannerSize::latest()->get();

        return view('advertise.create')->with([
            'publicationTypes' => $publicationTypes,
            'advertiseCosts' => $advertiseCosts,
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
            $advertise->cost_id = $request->cost_id ?? null;
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
                if(isset($request->is_jahir_nivida)){
                    if(isset($request->jahir_news_paper_type_id) && count($request->jahir_news_paper_type_id) > 0){
                        for($i=0; $i < count($request->jahir_news_paper_type_id); $i++){
                            if($request->jahir_news_paper_type_id[$i] != ""){
                                $advertiseNew = new AdvertiseNewsPaper;
                                $advertiseNew->advertise_id = $advertise->id;
                                $advertiseNew->news_paper_id = $request->jahir_news_paper_type_id[$i];
                                $advertiseNew->save();
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
                            }
                        }
                    }
                }
                $this->generatePdf($advertise);
            }

            DB::commit();

            return redirect()->route('send-mail.index', $advertise->id);
        }
        catch(\Exception $e)
        {
            Log::info($e);
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }
    }


    public function generatePdf($advertise){
        // $data = [];
        // $pdf = PDF::loadView('advertise.pdf', $data);

        // return $pdf->stream('document.pdf');
        $name = encrypt(time());

        DB::table('advertises')->where('id', $advertise->id)->update(['generate_pdf_url' => 'pdf/'.$name.'.pdf']);
    }

    public function pdf(Request $request){
        $html = '<h1>Hello, Snappy!</h1>';

        // Generate PDF from HTML
        $pdf = SnappyPdf::loadHTML($html);

        // Output the PDF to the browser or save it to a file
        return $pdf->download('document.pdf');
        // return 'dd';
        $data = [];
        // $pdf = PDF::loadView('advertise.pdf', $data);

        // return $pdf->stream('document.pdf');
    }

}
