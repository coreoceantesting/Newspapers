<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Models\Billing;
use App\Models\BudgetProvision;
use App\Models\Expandeture;

class DashboardController extends Controller
{
    public function dashboard(){
        $todayAdvertise = Advertise::whereDate('publication_date', date('Y-m-d'))->count();

        $thisMonthAdvertise = Advertise::whereMonth('publication_date', date('m'))->count();

        $thisYearAdvertise = Advertise::whereYear('publication_date', date('Y'))->count();

        $todayBill = Billing::whereDate('bill_date', date('Y-m-d'))->count();

        $thisMonthBill = Billing::whereMonth('bill_date', date('m'))->count();

        $thisYearBill = Billing::whereYear('bill_date', date('Y'))->count();

        $totalBudget = BudgetProvision::whereHas('financialYear', function($query){
            $query->where('year', date('Y'));
        })->value('budget');

        $totalAdvertiseCost = Billing::whereYear('bill_date', date('Y'))->sum('net_amount');

        $advertises = Advertise::with(['publicationType', 'printType', 'bannerSize'])->limit(5)->latest()->get();

        $billing = Billing::with(['accountDetails'])->where('is_expandeture_created', 0)->limit(5)->latest()->get();

        $expenses = Expandeture::limit(5)->latest()->get();

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
            'expenses' => $expenses
        ]);
    }
}
