<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdvertiseCostRequest;
use App\Models\AdvertiseCost;
use App\Models\Cost;
use App\Models\NewsPaperType;
use App\Models\Language;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AdvertiseCostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertiseCosts = AdvertiseCost::with(['newsPaperType', 'language', 'cost'])->latest()->get();

        return view('master.advertise-cost.index')->with(['advertiseCosts'=> $advertiseCosts]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        $newsPaperTypes = NewsPaperType::select('id', 'name')->latest()->get();

        $language = Language::select('id', 'name')->latest()->get();

        $costs = Cost::select('id', 'name')->latest()->get();

        return view('master.advertise-cost.create')->with([
            'newsPaperTypes' => $newsPaperTypes,
            'language' => $language,
            'costs' => $costs
        ]);
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(AdvertiseCostRequest $request)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            AdvertiseCost::create( Arr::only( $input, AdvertiseCost::getFillables() ) );
            DB::commit();

            return redirect()->route('advertise-cost.index')->with('success', 'News Paper Banner Size Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('advertise-cost.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(AdvertiseCost $advertiseCost)
    {
        $newsPaperTypes = NewsPaperType::select('id', 'name')->latest()->get();

        $language = Language::select('id', 'name')->latest()->get();

        $costs = Cost::select('id', 'name')->latest()->get();

        return view('master.advertise-cost.edit')->with([
            'advertiseCost' => $advertiseCost,
            'newsPaperTypes' => $newsPaperTypes,
            'language' => $language,
            'costs' => $costs,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertiseCostRequest $request, AdvertiseCost $advertiseCost)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $advertiseCost->update( Arr::only( $input, AdvertiseCost::getFillables() ) );
            DB::commit();

            return redirect()->route('advertise-cost.index')->with('success', 'News Paper Banner Size Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('advertise-cost.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(AdvertiseCost $advertiseCost)
    {
        try
        {
            DB::beginTransaction();
            $advertiseCost->delete();
            DB::commit();
            return redirect()->route('advertise-cost.index')->with('success', 'News Paper Banner Size Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('advertise-cost.index')->with('error', 'Something Went Wrog !');
        }
    }
}
