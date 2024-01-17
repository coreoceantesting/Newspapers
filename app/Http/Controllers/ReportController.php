<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\NewsPaper;
use App\Models\Billing;

class ReportController extends Controller
{
    public function index(Request $request){
        $departments = Department::latest()->get();

        $billing = [];

        if(isset($request->search)){
            $billing = Billing::with(['department', 'advertise.publicationType', 'newsPaper'])->where('department_id', $request->department);

            if($request->work_order_number != ""){
                $billing = $billing->where('advertise_id', $request->work_order_number);
            }

            if($request->bill_number != ""){
                $billing = $billing->where('id', $request->bill_number);
            }

            $billing = $billing->get();

        }
        // return $billing;
        return view('reports.index')->with([
            'departments' => $departments,
            'billing' => $billing
        ]);
    }
}
