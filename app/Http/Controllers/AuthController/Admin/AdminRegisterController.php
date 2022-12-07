<?php

namespace App\Http\Controllers\AuthController\Admin;

use App\Models\Admin;
use App\Traits\photoTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    use photoTrait; //Traits: For Save Images

    // Admin Register //
    public function register(){
        return view('myAuth.admin.register');
    }


    // Register An Admin
    public function store(Request $request){
        //validation

        $file_name = $this->savephoto($request->photo,'img/adminimg');

        Admin::create([
            "name" => $request->name,
            "email" =>$request->email,
            "password" => Hash::make($request->password),
            "photo"=>$file_name,
        ]);

        return response()->json([
            "status"=>true,
            "msg"=>"Admin added successfully",
        ]);

    }
}
