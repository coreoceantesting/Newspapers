<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CostRequest;
use App\Models\Cost;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costs = Cost::latest()->get();

        return view('master.cost.index')->with(['costs'=> $costs]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        return view('master.cost.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(CostRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            Cost::create( Arr::only( $input, Cost::getFillables() ) );
            DB::commit();

            return redirect()->route('cost.index')->with('success', 'News Paper Cost Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('cost.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(Cost $cost)
    {
        return view('master.cost.edit')->with([
            'cost' => $cost
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostRequest $request, Cost $cost)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $cost->update( Arr::only( $input, Cost::getFillables() ) );
            DB::commit();

            return redirect()->route('cost.index')->with('success', 'News Paper Cost Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('cost.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(Cost $cost)
    {
        try
        {
            DB::beginTransaction();
            $cost->delete();
            DB::commit();
            return redirect()->route('cost.index')->with('success', 'News Paper Cost Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('cost.index')->with('error', 'Something Went Wrog !');
        }
    }
}
