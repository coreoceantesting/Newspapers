<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\Department;
use App\Models\Advertise;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BillingRequest;
use App\Models\AdvertiseNewsPaper;
use App\Models\BudgetProvision;
use App\Models\AccountDetail;
use App\Models\FinancialYear;
use App\Exports\BillingExport;
use Maatwebsite\Excel\Facades\Excel;

class BillingController extends Controller
{
    public function index()
    {
        $billing = Billing::with(['department', 'newsPaper', 'accountDetails'])->when(request('from') && request('to'), function ($q) {
            $from = date('Y-m-d', strtotime(request('from'))) . " 00:00:00";
            $to = date('Y-m-d', strtotime(request('to'))) . " 23:59:59";
            return $q->where('bill_date', '>=', $from)->where('bill_date', '<=', $to);
        })->where('is_paid', 0)->latest()->get();

        return view('billing.index')->with([
            'billing' => $billing
        ]);
    }

    public function paid()
    {
        $billing = Billing::with(['department', 'newsPaper', 'accountDetails'])->when(request('from') && request('to'), function ($q) {
            $from = date('Y-m-d', strtotime(request('from'))) . " 00:00:00";
            $to = date('Y-m-d', strtotime(request('to'))) . " 23:59:59";
            return $q->where('bill_date', '>=', $from)->where('bill_date', '<=', $to);
        })->where('is_paid', 1)->latest()->get();

        return view('billing.paid')->with([
            'billing' => $billing
        ]);
    }

    public function create(Request $request)
    {
        $departments = Department::latest()->get();

        return view('billing.create')->with([
            'departments' => $departments
        ]);
    }

    public function store(BillingRequest $request)
    {
        try {
            $financialYear = FinancialYear::where('is_active', 1)->first();

            $totalBillAmount = Billing::where('bill_date', '>=', date('Y-m-d', strtotime($financialYear->from_date)))->where('bill_date', '<=', date('Y-m-d', strtotime($financialYear->to_date)))->sum('net_amount');

            $totalAmount = $totalBillAmount + $request->net_amount;

            $budget = BudgetProvision::whereHas('financialYear', function ($q) use ($request) {
                $q->where('is_active', '1');
            })->where('department_id', $request->department_id)->value('budget');

            if ($totalAmount > $budget) {
                return redirect()->route('billing.index')->with('error', 'Your budget is finished.');
            }

            DB::beginTransaction();
            try {
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
            } catch (\Exception $e) {
                DB::rollback();
                Log::info($e);
                return redirect()->route('billing.index')->with('error', 'Something is went wrong');
            }


            return redirect()->route('billing.index')->with('success', 'Bill Generated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }
    }

    public function edit($id)
    {
        $billing = Billing::with(['accountDetails'])->where('id', $id)->first();

        if ($billing->is_expandeture_created == "1") {
            return redirect()->route('billing.index');
        }

        $departments = Department::latest()->get();

        $workOrderNumbers = Advertise::select('id', 'work_order_number')->where('is_mail_send', 1)->latest()->get();


        $advertise = Advertise::with(['publicationType', 'printType', 'bannerSize'])->where('id', $billing->advertise_id)->latest()->first();

        $workOrderNumbers = Advertise::where('department_id', $billing->department_id)->select('id', 'work_order_number')->latest()->get();

        $accountDetails = AccountDetail::where('news_paper_id', $billing->news_paper_id)->get();

        $advertiseNewsPapers = AdvertiseNewsPaper::with('newsPaper')->whereHas('advertise', function ($query) use ($advertise) {
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


    public function update(BillingRequest $request)
    {
        try {
            $financialYear = FinancialYear::where('is_active', 1)->first();

            $totalBillAmount = Billing::where('bill_date', '>=', date('Y-m-d', strtotime($financialYear->from_date)))->where('bill_date', '<=', date('Y-m-d', strtotime($financialYear->to_date)))->where('id', '!=', $request->id)->sum('net_amount');

            $totalAmount = $totalBillAmount + $request->net_amount;

            $budget = BudgetProvision::whereHas('financialYear', function ($q) use ($request) {
                $q->where('is_active', '1');
            })->where('department_id', $request->department_id)->value('budget');
            if ($totalAmount > $budget) {
                return redirect()->route('billing.index')->with('error', 'Your budget is finished.');
            }

            DB::beginTransaction();
            try {
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
            } catch (\Exception $e) {
                DB::rollback();
                Log::info($e);
                return redirect()->route('billing.index')->with('error', 'Something is went wrong');
            }

            return redirect()->route('billing.index')->with('success', 'Bill Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something Went Wrog !');
        }
    }

    public function destroy(Billing $billing)
    {
        DB::beginTransaction();
        try {
            $billing->delete();
            DB::commit();
            return redirect()->route('billing.index')->with('success', 'Billi Removed Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e);
            return redirect()->route('billing.index')->with('error', 'Something Went Wrog !');
        }
    }

    public function show($id)
    {
        $billing = Billing::with(['department', 'newsPaper', 'accountDetails'])->where('id', $id)->latest()->first();
        // return $billing;
        return view('billing.show')->with(['billing' => $billing]);
    }

    public function export(Request $request)
    {
        $billing = Billing::with(['department', 'newsPaper', 'accountDetails'])->when(request('from') && request('to'), function ($q) {
            $from = date('Y-m-d', strtotime(request('from'))) . " 00:00:00";
            $to = date('Y-m-d', strtotime(request('to'))) . " 23:59:59";
            return $q->where('bill_date', '>=', $from)->where('bill_date', '<=', $to);
        })->where('is_paid', $request->is_paid)->latest()->get();

        return Excel::download(new BillingExport($billing), 'billing.xlsx');
    }

    public function paidBill(Request $request)
    {
        DB::beginTransaction();
        try {
            $billing = Billing::find($request->id);
            $billing->is_paid = 1;
            $billing->save();
            DB::commit();
            return redirect()->route('billing.paid')->with('success', 'Billi Paid Successfully');
        } catch (\Exception $e) {
            DB::rollback();
            Log::info($e);
            return redirect()->route('billing.paid')->with('error', 'Something Went Wrog !');
        }
    }
}
