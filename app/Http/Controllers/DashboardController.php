<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Models\Billing;
use App\Models\BudgetProvision;
use App\Models\Expandeture;
use App\Models\FinancialYear;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if (isset($request->financial_year) && $request->financial_year != "")
            $financialYear = FinancialYear::find($request->financial_year);
        else
            $financialYear = FinancialYear::where('is_active', 1)->first();

        if ($financialYear) {

            $todayAdvertise = Advertise::whereDate('publication_date', '>=', $financialYear->from_date)->whereDate('publication_date', '<=', $financialYear->to_date)->count();

            $thisMonthAdvertise = Advertise::whereDate('publication_date', '>=', $financialYear->from_date)->whereDate('publication_date', '<=', $financialYear->to_date)->whereMonth('publication_date', date('Y-m'))->count();

            $thisYearAdvertise = Advertise::whereDate('publication_date', '>=', $financialYear->from_date)->whereDate('publication_date', '<=', $financialYear->to_date)->count();

            $todayBill = Billing::whereDate('bill_date', '>=', $financialYear->from_date)->whereDate('bill_date', '<=', $financialYear->to_date)->count();

            $thisMonthBill = Billing::whereDate('bill_date', '<=', $financialYear->from_date)->whereDate('bill_date', '>=', $financialYear->to_date)->whereMonth('bill_date', date('Y-m'))->count();

            $thisYearBill = Billing::whereDate('bill_date', '>=', $financialYear->from_date)->whereDate('bill_date', '<=', $financialYear->to_date)->count();

            $totalBudget = BudgetProvision::whereHas('financialYear', function ($query) use ($financialYear) {
                $query->where('financial_year_id', $financialYear->id);
            })->value('budget');

            $totalAdvertiseCost = Billing::whereDate('bill_date', '>=', $financialYear->from_date)->whereDate('bill_date', '<=', $financialYear->to_date)->sum('net_amount');

            $advertises = Advertise::with(['publicationType', 'printType', 'bannerSize', 'department'])->whereDate('publication_date', '>=', $financialYear->from_date)->whereDate('publication_date', '<=', $financialYear->to_date)->limit(5)->latest()->get();

            $billing = Billing::with(['accountDetails'])->whereDate('bill_date', '>=', $financialYear->from_date)->whereDate('bill_date', '<=', $financialYear->to_date)->limit(5)->latest()->get();

            $expenses = Expandeture::whereDate('created_at', '>=', $financialYear->from_date)->whereDate('created_at', '<=', $financialYear->to_date)->limit(5)->latest()->get();

            $financialYears = FinancialYear::get();

            return view('dashboard')->with([
                'todayAdvertise' => $todayAdvertise,
                'thisMonthAdvertise' => $thisMonthAdvertise,
                'thisYearAdvertise' => $thisYearAdvertise,
                'todayBill' => $todayBill,
                'thisMonthBill' => $thisMonthBill,
                'thisYearBill' => $thisYearBill,
                'totalBudget' => $totalBudget,
                'totalAdvertiseCost' => $totalAdvertiseCost,
                'advertises' => $advertises,
                'billing' => $billing,
                'expenses' => $expenses,
                'financialYears' => $financialYears
            ]);
        } else {
            return back();
        }
    }
}
