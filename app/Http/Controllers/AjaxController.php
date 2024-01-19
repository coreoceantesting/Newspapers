<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\AdvertiseNewsPaper;
use App\Models\NewsPaperType;
use App\Models\Language;
use App\Models\Advertise;
use App\Models\AccountDetail;

class AjaxController extends Controller
{
    public function getNewsPaperType(Request $request){
        if($request->ajax()){

            $data = NewsPaperType::withWhereHas('advertiseCost', function($q) use($request){
                $q->where('cost_id', $request->cost_id)
                  ->with('language', function($lang){
                        $lang->select('id', 'name')
                             ->with('newsPapers');
                  });
            })->latest()->get();

            return response()->json([
                'status' => 200,
                'data' => $data,
            ]);
        }
    }

    public function getNotJahirNewsPaperType(Request $request){

        $newsPaperTypes = NewsPaperType::whereIn('id', $request->newsPaperType)->latest()->get();
        $data = [];
        foreach( $newsPaperTypes as $newsPaperType ){
            $id = $newsPaperType->id;
            $data[] = [
                'id' => $newsPaperType->id,
                'name' => $newsPaperType->name,
                'language' => Language::withWhereHas('newsPapers', function($query) use($id){
                    $query->where('news_paper_type_id', $id);
                })->whereIn('id', $request->language)->get()
            ];
        }

        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }


    public function getWorkOrderDetails(Request $request){
        if($request->ajax()){
            $advertise = Advertise::with(['publicationType', 'printType', 'bannerSize'])->where('id', $request->id)->latest()->first();

            $advertiseNewsPapers = AdvertiseNewsPaper::with('newsPaper')->whereHas('advertise', function($query) use($request){
                $query->where('id', $request->id);
            })->get();

            return response()->json([
                'status' => 200,
                'data' => $advertise,
                'advertiseNewsPapers' => $advertiseNewsPapers
            ]);
        }
    }

    public function getWorkOrderNumber(Request $request){
        if($request->ajax()){
            $advertise = Advertise::where('department_id', $request->department_id)->select('id', 'work_order_number')->latest()->distinct()->get();

            return response()->json([
                'status' => 200,
                'data' => $advertise
            ]);
        }
    }


    public function checkDuplicateBillNumber(Request $request){
        if($request->ajax()){
            $check = Billing::where('bill_number', $request->billNumber)->exists();

            if($check){
                return response()->json([
                    'status' => 200,
                    'data' => $request->billNumber
                ]);
            }

        }
    }


    public function checkDuplicateWorkOrderNumber(Request $request){
        if($request->ajax()){
            $check = Advertise::where('work_order_number', $request->workOrderNumber)->exists();

            if($check){
                return response()->json([
                    'status' => 200,
                    'data' => $request->workOrderNumber
                ]);
            }
        }
    }


    // function to get work order number by department id
    public function getWorkOrderNumberByDepartment(Request $request){
        if($request->ajax()){
            $workOrderNumber = Advertise::where('department_id', $request->department)->latest()->select('id', 'work_order_number')->get();

            return response()->json([
                'status' => 200,
                'data' => $workOrderNumber
            ]);
        }
    }

    // function to get bill number
    public function getNewsPaperByAdvertise(Request $request){
        if($request->ajax()){
            $advertise = AdvertiseNewsPaper::with('newsPaper')->where('advertise_id', $request->workOrderNumber)->get();

            return response()->json([
                'status' => 200,
                'data' => $advertise
            ]);
        }
    }

    // function to get account number of newspaper
    public function getNewsPaperAccountNumber(Request $request){
        if($request->ajax()){
            $accountNumber = AccountDetail::where('news_paper_id', $request->news_paper_id)->get();

            return response()->json([
                'status' => 200,
                'data' => $accountNumber
            ]);
        }
    }

    // function to get Account Number details
    public function getNewsPaperAccountDetails(Request $request){
        if($request->ajax()){
            $accountDetails = AccountDetail::where('id', $request->id)->first();

            return response()->json([
                'status' => 200,
                'data' => $accountDetails
            ]);
        }
    }

    // function to get billing details for expandature
    public function getBillingDetailsForExpandature(Request $request){
        if($request->ajax()){
            $billingDetail = Billing::with(['newsPaper'])->where('id', $request->bill)->first();

            return response()->json([
                'status' => 200,
                'data' => $billingDetail
            ]);
        }
    }
}
