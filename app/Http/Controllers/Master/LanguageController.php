<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::latest()->get();

        return view('master.language.index')->with(['languages'=> $languages]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        return view('master.language.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(LanguageRequest $request)
    {

        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            Language::create( Arr::only( $input, Language::getFillables() ) );
            DB::commit();

            return redirect()->route('language.index')->with('success', 'News Paper Language Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('language.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(Language $language)
    {
        return view('master.language.edit')->with([
            'language' => $language
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageRequest $request, Language $language)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $language->update( Arr::only( $input, Language::getFillables() ) );
            DB::commit();

            return redirect()->route('language.index')->with('success', 'News Paper Language Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('language.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(Language $language)
    {
        try
        {
            DB::beginTransaction();
            $language->delete();
            DB::commit();
            return redirect()->route('language.index')->with('success', 'News Paper Language Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('language.index')->with('error', 'Something Went Wrog !');
        }
    }


}
