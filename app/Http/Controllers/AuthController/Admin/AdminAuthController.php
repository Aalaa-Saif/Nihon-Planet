<?php

namespace App\Http\Controllers\AuthController\Admin;

use App\Models\admin;
use App\Traits\photoTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController\Admin\AdminAuthController;

class AdminAuthController extends Controller
{
    use photoTrait;

    //Dashboard of the Admin
    public function admin_dashboard(admin $adm){
        $admin = Auth::guard('admin')->user();
       // Auth::guard('admin')->loginUsingId(1);
        return view('layouts.admindashboard-app',['admin'=>$admin]);
    }

}
