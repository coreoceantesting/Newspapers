<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BudgetProvisionRequest;
use App\Models\FinancialYear;
use App\Models\Department;
use App\Models\BudgetProvision;
use App\Models\Expandeture;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BudgetProvisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $budgetProvisions = BudgetProvision::with(['financialYear', 'department'])->latest()->get();

        return view('master.budget-provision.index')->with(['budgetProvisions'=> $budgetProvisions]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        $financialYears = FinancialYear::select('id', 'year')->latest()->get();

        $departments = Department::select('id', 'name')->latest()->get();

        return view('master.budget-provision.create')->with([
            'financialYears' => $financialYears,
            'departments' => $departments
        ]);
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(BudgetProvisionRequest $request)
    {
        $check = BudgetProvision::where('financial_year_id', $request->financial_year_id)->exists();

        if($check){
            return redirect()->route('budget-provision.index')->with('error', 'Budget Already Exists of this year');
        }

        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            BudgetProvision::create( Arr::only( $input, BudgetProvision::getFillables() ) );
            DB::commit();

            return redirect()->route('budget-provision.index')->with('success', 'News Paper Budget Provision Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('budget-provision.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(BudgetProvision $budgetProvision)
    {
        $financialYears = FinancialYear::select('id', 'year')->latest()->get();

        $departments = Department::select('id', 'name')->latest()->get();

        return view('master.budget-provision.edit')->with([
            'budgetProvision' => $budgetProvision,
            'financialYears' => $financialYears,
            'departments' => $departments
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BudgetProvisionRequest $request, BudgetProvision $budgetProvision)
    {
        // dd($request);
        $check = BudgetProvision::where('financial_year_id', $request->financial_year_id)->where('id', '!=', $request->id)->exists();

        if($check){
            return redirect()->route('budget-provision.index')->with('error', 'Budget Already Exists of this year');
        }

        $expenseAmount = Expandeture::whereHas('billing.department.budgetProvision', function($q) use($request){
            return $q->where('id', $request->id);
        })->latest()->value('progressive_expandetures');

        try
        {
            DB::beginTransaction();

            if($expenseAmount > $request->budget){
                return redirect()->route('budget-provision.index')->with('error', 'Expense amount is more than budget amount');
            }else{
                $expenses = Expandeture::whereHas('billing.department.budgetProvision', function($q) use($request){
                    return $q->where('id', $request->id);
                })->get();
                $count = 1;
                $lastBalance = 0;
                $lastProgressiveExpandeture = 0;
                foreach($expenses as $expense){
                    if($count == "1"){
                        $budget = $request->budget;
                        $invoiceAmount = $expense->net_amount;
                        $otherCharges = $expense->other_charges;
                        $netAmount = $invoiceAmount - $otherCharges;
                        $prograssiveExpendature = $budget;
                        $balance = $budget - $invoiceAmount;
                    }else{
                        $invoiceAmount = $expense->net_amount;
                        $otherCharges = $expense->other_charges;
                        $netAmount = $invoiceAmount - $otherCharges;
                        $prograssiveExpendature = $invoiceAmount + $lastProgressiveExpandeture;
                        $balance = $lastBalance - $invoiceAmount;
                    }
                    $lastBalance = $balance;
                    $lastProgressiveExpandeture = $prograssiveExpendature;
                    $count = $count + 1;

                    DB::table('expandetures')->where('id', $expense->id)->update([
                        'invoice_amount' => $invoiceAmount,
                        'other_charges' => $otherCharges,
                        'net_amount' => $netAmount,
                        'progressive_expandetures' => $prograssiveExpendature,
                        'balance' => $balance,
                    ]);
                }
            }

            $input = $request->validated();
            $budgetProvision->update( Arr::only( $input, BudgetProvision::getFillables() ) );
            DB::commit();

            return redirect()->route('budget-provision.index')->with('success', 'News Paper Budget Provision Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('budget-provision.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(BudgetProvision $budgetProvision)
    {
        try
        {
            DB::beginTransaction();
            $budgetProvision->delete();
            DB::commit();
            return redirect()->route('budget-provision.index')->with('success', 'News Paper Budget Provision Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('budget-provision.index')->with('error', 'Something Went Wrog !');
        }
    }
}
