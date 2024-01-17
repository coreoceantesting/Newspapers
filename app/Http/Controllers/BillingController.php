<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Department;
use App\Models\Advertise;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BillingRequest;
use App\Models\AdvertiseNewsPaper;

class BillingController extends Controller
{
    public function index(){
        $billing = Billing::with(['department', 'newsPaper'])->select('id', 'department_id', 'news_paper_id', 'bill_number', 'bank', 'branch', 'account_number', 'irfc_code')->get();
        // return $billing;
        return view('billing.index')->with([
            'billing' => $billing
        ]);
    }

    public function create(Request $request){
        $departments = Department::latest()->get();

        $workOrderNumbers = Advertise::select('id', 'work_order_number')->latest()->distinct()->get('work_order_number');

        return view('billing.create')->with([
            'departments' => $departments,
            'workOrderNumbers' => $workOrderNumbers
        ]);
    }

    public function store(BillingRequest $request){
        try
        {
            DB::beginTransaction();
            $billing = new Billing;
            $billing->department_id = $request->department_id;
            $billing->advertise_id = $request->advertise_id;
            $billing->news_paper_id = $request->news_paper_id;
            $billing->bill_number = $request->bill_number;
            $billing->bank = $request->bank;
            $billing->branch = $request->branch;
            $billing->account_number = $request->account_number;
            $billing->irfc_code = $request->irfc_code;
            $billing->pan_card = $request->pan_card;
            $billing->bill_date = date('Y-m-d', strtotime($request->bill_date));
            $billing->basic_amount = $request->basic_amount;
            $billing->gst = $request->gst;
            $billing->gross_amount = $request->gross_amount;
            $billing->tds = $request->tds;
            $billing->it = $request->it;
            $billing->net_amount = $request->net_amount;
            $billing->save();
            DB::commit();

            return redirect()->route('billing.index');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }
    }

    public function edit($id){
        $departments = Department::latest()->get();

        $workOrderNumbers = Advertise::select('id', 'work_order_number')->latest()->distinct()->get('work_order_number');

        $billing = Billing::find($id);

        $advertise = Advertise::with(['publicationType', 'printType', 'bannerSize'])->where('id', $billing->advertise_id)->latest()->first();

        $workOrderNumbers = Advertise::where('department_id', $billing->department_id)->select('id', 'work_order_number')->latest()->distinct()->get();

        $advertiseNewsPapers = AdvertiseNewsPaper::with('newsPaper')->whereHas('advertise', function($query) use($advertise){
            $query->where('id', $advertise->id);
        })->get();

        return view('billing.edit')->with([
            'departments' => $departments,
            'workOrderNumbers' => $workOrderNumbers,
            'billing' => $billing,
            'advertise' => $advertise,
            'workOrderNumbers' => $workOrderNumbers,
            'advertiseNewsPapers' => $advertiseNewsPapers
        ]);
    }


    public function update(BillingRequest $request){
        try
        {
            DB::beginTransaction();
            $billing = Billing::find($request->id);
            $billing->department_id = $request->department_id;
            $billing->advertise_id = $request->advertise_id;
            $billing->news_paper_id = $request->news_paper_id;
            $billing->bill_number = $request->bill_number;
            $billing->bank = $request->bank;
            $billing->branch = $request->branch;
            $billing->account_number = $request->account_number;
            $billing->irfc_code = $request->irfc_code;
            $billing->pan_card = $request->pan_card;
            $billing->bill_date = date('Y-m-d', strtotime($request->bill_date));
            $billing->basic_amount = $request->basic_amount;
            $billing->gst = $request->gst;
            $billing->gross_amount = $request->gross_amount;
            $billing->tds = $request->tds;
            $billing->it = $request->it;
            $billing->net_amount = $request->net_amount;
            $billing->save();
            DB::commit();

            return redirect()->route('billing.index');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }
    }

    public function destroy(Billing $billing)
    {
        try
        {
            DB::beginTransaction();
            $billing->delete();
            DB::commit();
            return redirect()->route('billing.index')->with('success', 'Billi Removed Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('billing.index')->with('error', 'Something Went Wrog !');
        }
    }
}
