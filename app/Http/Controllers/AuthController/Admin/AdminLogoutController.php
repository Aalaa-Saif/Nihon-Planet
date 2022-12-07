<?php

namespace App\Http\Controllers\AuthController\Admin;

use Session;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLogoutController extends Controller
{
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect()->route('admin_login');
    }

}
