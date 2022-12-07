<?php

namespace App\Http\Controllers\AuthController\User;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    #Blade User Login
    public function login(){
        return view('myAuth.user.login');
    }


    #Login Check
    public function login_check(Request $request){
        #validation

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            return redirect()->route('o_profile');
        }
        return redirect()->back()->onlyInput('email');
    }



}
