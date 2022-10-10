<?php

namespace App\Http\Controllers\AuthController\User;

use App\Models\User;
use App\Traits\photoTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\userReqisterRequest;

class RegisterController extends Controller
{
    use photoTrait;

    // Blade Register User
    public function register(){
        return view('myAuth.user.register');
    }

    public function store(userReqisterRequest $request){
        //validation

        $file_name = $this->savephoto($request->photo,'img/userimg');

        User::create([
            "name" => $request->name,
            "email" =>$request->email,
            "password" => Hash::make($request->password),
            "photo"=>$file_name,
        ]);

        return response()->json([
            "status"=>true,
            "msg"=>__("messages.regjsonsuccess"),
        ]);
    }
}
