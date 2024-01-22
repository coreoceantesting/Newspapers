<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Department;
use App\Models\Advertise;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BillingRequest;
use App\Models\AdvertiseNewsPaper;
use App\Models\AccountDetail;

class BillingController extends Controller
{
    public function index(){
        $billing = Billing::with(['department', 'newsPaper', 'accountDetails'])->latest()->get();
        // return $billing;
        return view('billing.index')->with([
            'billing' => $billing
        ]);
    }

    public function create(Request $request){
        $departments = Department::latest()->get();

        return view('billing.create')->with([
            'departments' => $departments
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
            $billing->account_detail_id = $request->account_detail_id;
            $billing->bill_date = date('Y-m-d', strtotime($request->bill_date));
            $billing->basic_amount = $request->basic_amount;
            $billing->gst = $request->gst;
            $billing->gross_amount = $request->gross_amount;
            $billing->tds = $request->tds;
            $billing->it = $request->it;
            $billing->net_amount = $request->net_amount;
            $billing->save();
            DB::commit();

            return redirect()->route('billing.index')->with('success', 'Bill Generated Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }
    }

    public function edit($id){
        $billing = Billing::with(['accountDetails'])->where('id', $id)->first();

        if($billing->is_expandeture_created == "1"){
            return redirect()->route('billing.index');
        }

        $departments = Department::latest()->get();

        $workOrderNumbers = Advertise::select('id', 'work_order_number')->latest()->distinct()->get('work_order_number');


        $advertise = Advertise::with(['publicationType', 'printType', 'bannerSize'])->where('id', $billing->advertise_id)->latest()->first();

        $workOrderNumbers = Advertise::where('department_id', $billing->department_id)->select('id', 'work_order_number')->latest()->distinct()->get();

        $accountDetails = AccountDetail::where('news_paper_id', $billing->news_paper_id)->get();

        $advertiseNewsPapers = AdvertiseNewsPaper::with('newsPaper')->whereHas('advertise', function($query) use($advertise){
            $query->where('id', $advertise->id);
        })->get();

        return view('billing.edit')->with([
            'departments' => $departments,
            'workOrderNumbers' => $workOrderNumbers,
            'billing' => $billing,
            'advertise' => $advertise,
            'workOrderNumbers' => $workOrderNumbers,
            'advertiseNewsPapers' => $advertiseNewsPapers,
            'accountDetails' => $accountDetails
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
            $billing->account_detail_id = $request->account_detail_id;
            $billing->bill_number = $request->bill_number;
            $billing->bill_date = date('Y-m-d', strtotime($request->bill_date));
            $billing->basic_amount = $request->basic_amount;
            $billing->gst = $request->gst;
            $billing->gross_amount = $request->gross_amount;
            $billing->tds = $request->tds;
            $billing->it = $request->it;
            $billing->net_amount = $request->net_amount;
            $billing->save();
            DB::commit();

            return redirect()->route('billing.index')->with('success', 'Bill Updated Successfully');
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
