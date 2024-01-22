<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Expandeture;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ExpandatureRequest;

class ExpandetureController extends Controller
{
    public function index(){
        $expandatures = Expandeture::with(['billing', 'newsPaper'])->get();

        return view('expandeture.index')->with([
            'expandatures' => $expandatures
        ]);
    }

    public function create(Request $request){
        $bills = Billing::where('is_expandeture_created', 0)->select('id', 'bill_number')->get();

        return view('expandeture.create')->with([
            'bills' => $bills
        ]);
    }

    public function store(ExpandatureRequest $request){
        try
        {
            DB::beginTransaction();
            $expandeture = new Expandeture;
            $expandeture->billing_id = $request->billing_id;
            $expandeture->news_paper_id = $request->news_paper_id;
            $expandeture->unique_no = 'File-'.time();
            $expandeture->invoice_amount = $request->invoice_amount;
            $expandeture->other_charges = $request->other_charges;
            $expandeture->net_amount = $request->net_amount;
            $expandeture->progressive_expandetures = $request->progressive_expandetures;
            $expandeture->balance = $request->balance;
            $expandeture->save();

            DB::table('billing')->where('id', $request->billing_id)->update([
                'is_expandeture_created' => 1
            ]);
            DB::commit();

            return redirect()->route('expandeture.index')->with('success', 'Expandature Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }

    }

    public function edit(Request $request){

    }

    public function update(Request $request){

    }

    public function destroy(Request $request){

    }
}
