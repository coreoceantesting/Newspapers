<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Models\Billing;

class DashboardController extends Controller
{
    public function dashboard(){
        $totalAdvertise = Advertise::count();

        $totalBilling = Billing::count();

        return view('dashboard')->with([
            'totalAdvertise' => $totalAdvertise,
            'totalBilling' => $totalBilling
        ]);
    }
}
