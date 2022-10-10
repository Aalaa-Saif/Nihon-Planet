<?php

namespace App\Http\Controllers\AuthController\User;

use Session;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('otaku_login');
    }
}
