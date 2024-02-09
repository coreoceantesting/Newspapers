<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Models\Billing;
use App\Models\BudgetProvision;

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

        $advertises = Advertise::with(['publicationType', 'printType', 'bannerSize'])->limit(5)->latest()->get();

        $totalAdvertiseCost = Billing::whereYear('bill_date', date('Y'))->sum('net_amount');

        return view('dashboard')->with([
            'todayAdvertise' => $todayAdvertise,
            'thisMonthAdvertise' => $thisMonthAdvertise,
            'thisYearAdvertise' => $thisYearAdvertise,
            'todayBill' => $todayBill,
            'thisMonthBill' => $thisMonthBill,
            'thisYearBill' => $thisYearBill,
            'totalBudget' => $totalBudget,
            'totalAdvertiseCost' => $totalAdvertiseCost,
            'advertises' => $advertises
        ]);
    }
}
