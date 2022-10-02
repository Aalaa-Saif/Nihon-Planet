<?php

namespace App\Http\Controllers\AuthController\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Blade Register User
    public function register(){
        return view('myAuth.user.register');
    }

    public function store(authRequest $request){
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
