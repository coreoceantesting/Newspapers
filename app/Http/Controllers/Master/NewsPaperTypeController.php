<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NewsPaperTypeRequest;
use App\Models\NewsPaperType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class NewsPaperTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newsPaperTypes = NewsPaperType::latest()->get();

        return view('master.news-paper-type.index')->with(['newsPaperTypes'=> $newsPaperTypes]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        return view('master.news-paper-type.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(NewsPaperTypeRequest $request)
    {

        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            NewsPaperType::create( Arr::only( $input, NewsPaperType::getFillables() ) );
            DB::commit();

            return redirect()->route('news-paper-type.index')->with('success', 'News Paper Type Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('news-paper-type.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(NewsPaperType $newsPaperType)
    {
        return view('master.news-paper-type.edit')->with([
            'newsPaperType' => $newsPaperType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsPaperTypeRequest $request, NewsPaperType $newsPaperType)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $newsPaperType->update( Arr::only( $input, NewsPaperType::getFillables() ) );
            DB::commit();

            return redirect()->route('news-paper-type.index')->with('success', 'News Paper Type Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('news-paper-type.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(NewsPaperType $newsPaperType)
    {
        try
        {
            DB::beginTransaction();
            $newsPaperType->delete();
            DB::commit();
            return redirect()->route('news-paper-type.index')->with('success', 'News Paper Type Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('news-paper-type.index')->with('error', 'Something Went Wrog !');
        }
    }
}
