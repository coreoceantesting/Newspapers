<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PrintTypeRequest;
use App\Models\PrintType;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PrintTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $printTypes = PrintType::latest()->get();

        return view('master.print-type.index')->with(['printTypes'=> $printTypes]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        return view('master.print-type.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(PrintTypeRequest $request)
    {

        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            PrintType::create( Arr::only( $input, PrintType::getFillables() ) );
            DB::commit();

            return redirect()->route('print-type.index')->with('success', 'News Paper Print Type Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('print-type.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(PrintType $printType)
    {
        return view('master.print-type.edit')->with([
            'printType' => $printType
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrintTypeRequest $request, PrintType $printType)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $printType->update( Arr::only( $input, PrintType::getFillables() ) );
            DB::commit();

            return redirect()->route('print-type.index')->with('success', 'News Paper Print Type Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('print-type.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(PrintType $printType)
    {
        try
        {
            DB::beginTransaction();
            $printType->delete();
            DB::commit();
            return redirect()->route('print-type.index')->with('success', 'News Paper Print Type Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('print-type.index')->with('error', 'Something Went Wrog !');
        }
    }
}
