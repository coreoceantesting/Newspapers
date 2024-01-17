<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PublicationTypeRequest;
use App\Models\PublicationType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PublicationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publicationTypes = PublicationType::latest()->get();

        return view('master.publication-type.index')->with(['publicationTypes'=> $publicationTypes]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        return view('master.publication-type.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(PublicationTypeRequest $request)
    {

        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            PublicationType::create( Arr::only( $input, PublicationType::getFillables() ) );
            DB::commit();

            return redirect()->route('publication-type.index')->with('success', 'News Paper Publication Type Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('publication-type.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(PublicationType $publicationType)
    {
        return view('master.publication-type.edit')->with([
            'publicationType' => $publicationType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PublicationTypeRequest $request, PublicationType $publicationType)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $publicationType->update( Arr::only( $input, PublicationType::getFillables() ) );
            DB::commit();

            return redirect()->route('publication-type.index')->with('success', 'News Paper Publication Type Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('publication-type.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(PublicationType $publicationType)
    {
        try
        {
            DB::beginTransaction();
            $publicationType->delete();
            DB::commit();
            return redirect()->route('publication-type.index')->with('success', 'News Paper Publication Type Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('publication-type.index')->with('error', 'Something Went Wrog !');
        }
    }
}
