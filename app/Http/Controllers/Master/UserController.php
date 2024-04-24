<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('master.user.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new Language.
     */

    public function create()
    {
        return view('master.user.create');
    }

    /**
     * Store a newly created language  in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            DB::beginTransaction();
            $request['password'] = bcrypt($request->password);
            User::create($request->all());
            DB::commit();

            return redirect()->route('user.index')->with('success', 'User Created Successfully');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Show the form for editing the specified language.
     */
    public function edit(User $user)
    {
        return view('master.user.edit')->with([
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();
            if ($request->password == "") {
                $request['password'] = $user->password;
            } else {
                $request['password'] = bcrypt($request->password);
            }
            $user->update($request->all());
            DB::commit();

            return redirect()->route('user.index')->with('success', 'User Update Successfully');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Something Went Wrog !');
        }
    }

    /**
     * Remove the specified language from storage.
     */
    // public function destroy(User $user)
    // {
    //     try {
    //         DB::beginTransaction();
    //         $user->delete();
    //         DB::commit();
    //         return redirect()->route('user.index')->with('success', 'User Delete Successfully');
    //     } catch (\Exception $e) {
    //         return redirect()->route('user.index')->with('error', 'Something Went Wrog !');
    //     }
    // }
}
