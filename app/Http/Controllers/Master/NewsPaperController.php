<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsPaperRequest;
use App\Models\NewsPaper;
use App\Models\NewsPaperType;
use App\Models\Language;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class NewsPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsPapers = NewsPaper::with(['newsPaperType', 'language'])->latest()->get();

        return view('master.news-paper.index')->with(['newsPapers'=> $newsPapers]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        $newsPaperTypes = NewsPaperType::select('id', 'name')->latest()->get();

        $languages = Language::select('id', 'name')->latest()->get();

        return view('master.news-paper.create')->with([
            'newsPaperTypes' => $newsPaperTypes,
            'languages' => $languages
        ]);
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(NewsPaperRequest $request)
    {

        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $email = "";
            if(isset($request->email)){
                for($i=0; $i < count($request->email); $i++){
                    $email .= $request->email[$i]. ', ';
                }
                $email = substr($email, 0, -2);
            }
            $mobile = "";
            if(isset($request->mobile)){
                for($i=0; $i < count($request->mobile); $i++){
                    $mobile .= $request->mobile[$i]. ', ';
                }
                $mobile = substr($mobile, 0, -2);
            }

            $input['email'] = $email;
            $input['mobile'] = $mobile;
            NewsPaper::create( Arr::only( $input, NewsPaper::getFillables() ) );
            DB::commit();

            return redirect()->route('news-paper.index')->with('success', 'News Paper Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('news-paper.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(NewsPaper $newsPaper)
    {
        $newsPaperTypes = NewsPaperType::select('id', 'name')->latest()->get();

        $languages = Language::select('id', 'name')->latest()->get();

        return view('master.news-paper.edit')->with([
            'newsPaper' => $newsPaper,
            'newsPaperTypes' => $newsPaperTypes,
            'languages' => $languages
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsPaperRequest $request, NewsPaper $newsPaper)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $email = "";
            if(isset($request->email)){
                for($i=0; $i < count($request->email); $i++){
                    $email .= $request->email[$i]. ', ';
                }
                $email = substr($email, 0, -2);
            }
            $mobile = "";
            if(isset($request->mobile)){
                for($i=0; $i < count($request->mobile); $i++){
                    $mobile .= $request->mobile[$i]. ', ';
                }
                $mobile = substr($mobile, 0, -2);
            }

            $input['email'] = $email;
            $input['mobile'] = $mobile;
            $newsPaper->update( Arr::only( $input, NewsPaper::getFillables() ) );
            DB::commit();

            return redirect()->route('news-paper.index')->with('success', 'News Paper Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('news-paper.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(NewsPaper $newsPaper)
    {
        try
        {
            DB::beginTransaction();
            $newsPaper->delete();
            DB::commit();
            return redirect()->route('news-paper.index')->with('success', 'News Paper Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('news-paper.index')->with('error', 'Something Went Wrog !');
        }
    }
}
