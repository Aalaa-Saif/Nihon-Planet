<?php

namespace App\Http\Controllers\AuthController\Admin;

use Session;
use messages;
use App\Models\ad;
use App\Models\admin;
use App\Traits\photoTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    use photoTrait;

    //Dashboard of the Admin
    public function admin_dashboard(admin $adm){
        $admin = Auth::guard('admin')->user();
       // Auth::guard('admin')->loginUsingId(1);
        return view('layouts.admindashboard-app',['admin'=>$admin]);
    }



    // Store an Advertisement -> to user Post page //
    public function ad_store(Request $request){
        //validation

        $file_name = $this->savephoto($request->photo,'img/ad');
        ad::create([
            'text'=>$request->text,
            'media'=>$request->media,
        ]);

        return response()->json([
            "status"=>true,
            "msg"=>"Ad added successfully",
        ]);
    }



     // View an Advertisement -> to user Post page //
     public function ad_create(){
        $admin = Auth::guard('admin')->user();
        return view('admindashboard.ad',['admin'=>$admin]);
    }



}
