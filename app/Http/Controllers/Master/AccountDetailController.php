<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountDetail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AccountDetailRequest;
use App\Models\NewsPaper;

class AccountDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accountDetails = AccountDetail::with(['newsPaper'])->latest()->get();

        return view('master.account-detail.index')->with(['accountDetails' => $accountDetails]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create()
    {
        $newsPapers = NewsPaper::latest()->get();

        return view('master.account-detail.create')->with([
            'newsPapers' => $newsPapers
        ]);
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(AccountDetailRequest $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->validated();
            if ($request->hasFile('document')) {
                $document = $request->document->store('accountDetails');
                $input['document'] = $document;
            }
            AccountDetail::create(Arr::only($input, AccountDetail::getFillables()));
            DB::commit();

            return redirect()->route('account-details.index')->with('success', 'News Paper Account Details Created Successfully');
        } catch (\Exception $e) {
            return redirect()->route('account-details.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Show the form for editing the specified language.
     */
    public function edit(AccountDetail $accountDetail)
    {
        // return redirect()->route('account-details.index')->with('error', 'Something Went Wrog !');

        $newsPapers = NewsPaper::latest()->get();

        return view('master.account-detail.edit')->with([
            'accountDetail' => $accountDetail,
            'newsPapers' => $newsPapers
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountDetailRequest $request, AccountDetail $accountDetail)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('documents')) {
                if (Storage::exists($accountDetail->document)) {
                    Storage::delete($accountDetail->document);
                }
                $document = $request->documents->store('accountDetails');
                $request['document'] = $document;
            }

            $accountDetail->update($request->all());
            DB::commit();

            return redirect()->route('account-details.index')->with('success', 'News Paper Account Details Update Successfully');
        } catch (\Exception $e) {
            return redirect()->route('account-details.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(AccountDetail $accountDetail)
    {
        try {
            DB::beginTransaction();
            if (Storage::exists($accountDetail->document)) {
                Storage::delete($accountDetail->document);
            }
            $accountDetail->delete();
            DB::commit();
            return redirect()->route('account-details.index')->with('success', 'News Paper Account Details Delete Successfully');
        } catch (\Exception $e) {
            return redirect()->route('account-details.index')->with('error', 'Something Went Wrog !');
        }
    }
}
