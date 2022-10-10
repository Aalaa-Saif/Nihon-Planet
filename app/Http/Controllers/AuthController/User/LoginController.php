<?php

namespace App\Http\Controllers\AuthController\User;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    //Blade User Login
    public function login(){
        return view('myAuth.user.login');
    }


    //Login Check
    public function login_check(Request $request){
        //validation

        $credentials = $request->only('email', 'password');
        //Auth::guard('')
        if(Auth::attempt($credentials)){
            //if( Auth::guard('admin')->loginUsingId(1)){
            return redirect()->intended('otaku profile');
        }
        return redirect()->back()->onlyInput('email');
    }
}
