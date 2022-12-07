<?php

namespace App\Http\Controllers\AuthController\Admin;

use File;
use App\Models\Admin;
use App\Traits\photoTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController\Admin\AdminAuthController;

class AdminAuthController extends Controller
{
    use photoTrait;

    #Dashboard of the Admin
    public function admin_dashboard(Admin $adm){
        $admin = Auth::guard('admin')->user();
       // Auth::guard('admin')->loginUsingId(1);
        return view('layouts.admindashboard-app',['admin'=>$admin]);
    }

    # update profile
    public function update(Request $request){
        $profile_update = Admin::find($request->id);
        if(!$profile_update)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

         #update
         if($request->has('photo')){
            $path = public_path('/img/adminimg/'.$profile_update->photo);
            if(File::exists($path)){
                File::delete($path);
            }
           $img = $request->file('photo');
           $img_ext = $img->extension();
           $img_name = time().rand(1,4000).'.'.$img_ext;
           $path = 'img/adminimg';
           $img ->move($path,$img_name);
        }
        else {
            $img_name = $profile_update->photo;
        }
        $profile_update->name = $request->name;
        $profile_update->photo = $img_name;
        $profile_update->update();

        return response()->json([
            "status"=>true,
            "msg"=>"Update done Successfully"
        ]);
    }
}
