<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\FinancialYear;
use App\Models\Expandeture;
use App\Models\AccountDetail;
use App\Models\Advertise;
use App\Models\AdvertiseNewsPaper;
use PDF;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::latest()->get();

        $billing = [];
        $workOrderNumbers = null;
        $newsPapers = null;

        if (isset($request->department) && $request->department != "") {
            $workOrderNumbers = Advertise::whereHas('billing')->where('department_id', $request->department)->get();
        }

        if (isset($request->work_order_number) && $request->work_order_number != "") {
            $newsPapers = AdvertiseNewsPaper::with('newsPaper')->where('advertise_id', $request->work_order_number)->get();
        }
        // return $workOrderNumbers;
        if (isset($request->search)) {
            $billing = AccountDetail::withWhereHas('billing', function ($query) use ($request) {
                if (isset($request->work_order_number) && $request->work_order_number != "") {
                    $query->where('advertise_id', $request->work_order_number);
                }

                if (isset($request->news_paper) && $request->news_paper != "") {
                    $query->where('news_paper_id', $request->news_paper);
                }

                if (isset($request->department) && $request->department != "") {
                    $query->where('department_id', $request->department)->with(['department', 'advertise.publicationType']);
                }
            })->get();
        }
        // return $billing;
        return view('reports.index')->with([
            'departments' => $departments,
            'billings' => $billing,
            'workOrderNumbers' => $workOrderNumbers,
            'newsPapers' => $newsPapers
        ]);
    }

    // function for expandature report
    public function expandature()
    {
        $departments = Department::latest()->select('id', 'name')->get();

        return view('reports.expandature')->with([
            'departments' => $departments
        ]);
    }

    // function to display expandature pdf
    public function expandaturePdf(Request $request)
    {
        $financialYear = FinancialYear::withWhereHas('budgetProvision', function ($q) use ($request) {
            return $q->where('department_id', $request->department);
        })->where('is_active', 1)->first();

        $expendatures = Expandeture::whereHas('billing', function ($q) use ($request) {
            $q->where('department_id', $request->department);
        })->with(['newsPaper'])->when(request('from'), function ($q) {
            $from = date('Y-m-d', strtotime(request('from'))) . " 00:00:00";
            return $q->where('created_at', '>=', $from);
        })->when(request('to'), function ($q) {
            $to = date('Y-m-d', strtotime(request('to'))) . " 23:59:59";
            return $q->where('created_at', '<=', $to);
        })->get();

        $department = Department::where('id', $request->department)->value('name');

        $pdf = PDF::loadView(
            'reports.expandature-pdf',
            [
                'expendatures' => $expendatures,
                'financialYear' => $financialYear,
                'department' => $department
            ],
            [],
            [
                'title' => 'Certificate',
                'format' => 'A4-L',
                'orientation' => 'L'
            ]
        );

        return $pdf->stream('document.pdf', 'F');
    }
}
