<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        $date = "2024-09-11";
        return \Carbon\Carbon::createFromFormat('Y-d-m', $date)->subDays(5)->format('d-m-Y');
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } else {
            return view('login');
        }
    }
}
