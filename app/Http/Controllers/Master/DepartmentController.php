<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->get();

        return view('master.department.index')->with(['departments'=> $departments]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create(){
        return view('master.department.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(DepartmentRequest $request)
    {
        try
        {
            // dd('d');
            DB::beginTransaction();
            $input = $request->validated();
            Department::create( Arr::only( $input, Department::getFillables() ) );
            DB::commit();

            return redirect()->route('department.index')->with('success', 'News Paper Department Created Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('department.index')->with('error', 'Something Went Wrog !');
        }
    }

     /**
     * Show the form for editing the specified language.
     */
    public function edit(Department $department)
    {
        return view('master.department.edit')->with([
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        try
        {
            DB::beginTransaction();
            $input = $request->validated();
            $department->update( Arr::only( $input, Department::getFillables() ) );
            DB::commit();

            return redirect()->route('department.index')->with('success', 'News Paper Department Update Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('department.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    public function destroy(Department $department)
    {
        try
        {
            DB::beginTransaction();
            $department->delete();
            DB::commit();
            return redirect()->route('department.index')->with('success', 'News Paper Department Delete Successfully');
        }
        catch(\Exception $e)
        {
            return redirect()->route('department.index')->with('error', 'Something Went Wrog !');
        }
    }
}
