<?php

namespace App\Http\Controllers\AuthController\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
     //Admin Login Blade//
     public function login(){
        return view('myAuth.admin.login');
    }


    public function admin_check(Request $request){
        //validation

        $credentials = $request->only('email', 'password');

        //Auth::guard('')
        if(Auth::guard('admin')->attempt($credentials)){

            return redirect()->route('admin_dashboard');
        }
        return redirect()->back()->onlyInput('email');
    }
}
