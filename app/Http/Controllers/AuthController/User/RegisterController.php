<?php

namespace App\Http\Controllers\AuthController\User;

use App\Models\User;
use App\Models\VerifyUser;
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

        $user= User::create([
            "name" => $request->name,
            "email" =>$request->email,
            "password" => Hash::make($request->password),
            "photo"=>$file_name,
        ]);

        $last_id = $user->id;
        $token = $last_id.hash('sha256', \Str::random(120));
        $verifyURL = route('user_verify',['token'=>$token,'service'=>'Email_verification']);

        VerifyUser::create([
            'user_id'=>$last_id,
            'token'=>$token,
        ]);

        $message = 'Dear <b>'.$request->name.'</b>';
        $message.= 'Thanks for verifing the email';

        $mail_data = [
            'recipient'=>$request->email,
            'fromEmail'=>env('MAIL_FROM_ADDRESS'),
            'fromName'=>$request->name,
            'subject'=>'Email Verifivcation',
            'body'=>$message,
            'actionLink'=>$verifyURL,
        ];
        \Mail::send('email-template',$mail_data, function($message) use ($mail_data){
            $message->to($mail_data['recipient'])
                    ->from($mail_data['fromEmail'])
                    ->subject($mail_data['subject']);
        });

        /*return response()->json([
            "status"=>true,
            "msg"=>__("messages.regjsonsuccess"),
        ]);*/
        return redirect()->back()->with('success','You need to verify your email,please check');

    }

    public function verify(Request $request){
        $token = $request->token;
        $verifyUser = VerifyUser::where('token',$token)->first();
        if(!is_null($verifyUser)){
            $user =  $verifyUser->user;

            if(!$user->email_verified){
                $verifyUser->user->email_verified = 1;
                $verifyUser->user->save();

                return redirect()->route('otaku_login')->with('info','Your email verified seccessfully')
                ->with('verifiedEmail',$user->email);
            } else{
                return redirect()->route('otaku_login')->with('fail','You have to confirm your email')
                ->with('verifiedEmail',$user->email);
            }
        }
    }
}
