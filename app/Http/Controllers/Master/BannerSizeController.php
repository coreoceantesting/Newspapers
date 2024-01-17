<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BannerSizeRequest;
use App\Models\BannerSize;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BannerSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bannerSizes = BannerSize::latest()->get();

        return view('master.banner-size.index')->with(['bannerSizes'=> $bannerSizes]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        return view('master.banner-size.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(BannerSizeRequest $request)
    {

        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            BannerSize::create( Arr::only( $input, BannerSize::getFillables() ) );
            DB::commit();

            return redirect()->route('banner-size.index')->with('success', 'News Paper Banner Size Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('banner-size.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(BannerSize $bannerSize)
    {
        return view('master.banner-size.edit')->with([
            'bannerSize' => $bannerSize
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerSizeRequest $request, BannerSize $bannerSize)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $bannerSize->update( Arr::only( $input, BannerSize::getFillables() ) );
            DB::commit();

            return redirect()->route('banner-size.index')->with('success', 'News Paper Banner Size Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('banner-size.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(BannerSize $bannerSize)
    {
        try
        {
            DB::beginTransaction();
            $bannerSize->delete();
            DB::commit();
            return redirect()->route('banner-size.index')->with('success', 'News Paper Banner Size Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('banner-size.index')->with('error', 'Something Went Wrog !');
        }
    }
}
