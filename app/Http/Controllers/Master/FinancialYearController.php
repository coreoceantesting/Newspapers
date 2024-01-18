<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FinancialYearRequest;
use App\Models\FinancialYear;
use Illuminate\Support\Facades\DB;

class FinancialYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $financialYears = FinancialYear::latest()->get();

        return view('master.financial-year.index')->with(['financialYears'=> $financialYears]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        return view('master.financial-year.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(FinancialYearRequest $request)
    {
        try
        {
            DB::beginTransaction();
            DB::table('financial_years')->update(['is_active' => 0]);
            $financialYear = new FinancialYear;
            $financialYear->year = $request->year;
            $financialYear->from_date = date('Y-m-d', strtotime($request->from_date));
            $financialYear->to_date = date('Y-m-d', strtotime($request->to_date));
            $financialYear->is_active = 1;
            $financialYear->sequence = $request->sequence;
            $financialYear->save();
            DB::commit();

            return redirect()->route('financial-year.index')->with('success', 'News Paper Financial Year Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('financial-year.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(FinancialYear $financialYear)
    {
        return view('master.financial-year.edit')->with([
            'financialYear' => $financialYear
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinancialYearRequest $request)
    {
        // dd($request);
        try
        {
            DB::beginTransaction();
            $financialYear = FinancialYear::find($request->id);
            $financialYear->year = $request->year;
            $financialYear->from_date = date('Y-m-d', strtotime($request->from_date));
            $financialYear->to_date = date('Y-m-d', strtotime($request->to_date));
            $financialYear->sequence = $request->sequence;
            $financialYear->save();
            DB::commit();

            return redirect()->route('financial-year.index')->with('success', 'News Paper Financial Year Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('financial-year.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(FinancialYear $financialYear)
    {
        try
        {
            DB::beginTransaction();
            $financialYear->delete();
            DB::commit();
            return redirect()->route('financial-year.index')->with('success', 'News Paper Financial Year Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('financial-year.index')->with('error', 'Something Went Wrog !');
        }
    }
}
