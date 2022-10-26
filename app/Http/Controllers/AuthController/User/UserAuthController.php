<?php

namespace App\Http\Controllers\AuthController\User;

use Session;
use messages;
use App\Models\ad;
use App\Models\User;
use App\Models\userpost;
use App\Traits\photoTrait;
use App\Models\usercomment;
use App\Models\userpostimg;
use Illuminate\Http\Request;
use App\Http\Requests\authRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    use photoTrait;


    // Store Posts & Images
    public function post_store(Request $request){
        //validator
        $conn_id = Auth::user()->id;
        //insert
        $new_post = userpost::create([
            'user_id' => $conn_id,
            'text' => $request->text,
        ]);

        if($request->has('image')){
            foreach($request->file('image') as $img){
                $img_ext = $img->extension();
                $img_name = time().rand(1,4000).'.'.$img_ext;
                $path = 'img/userpostimg';
                $img ->move($path,$img_name);

                userpostimg::create([
                    'userpost_id' => $new_post->id,
                    'image' => $img_name
                ]);
            }
        }

        return response() ->json([
            "status"=>true,
            "msg"=>__("messages.postjsonsuccess"),
        ]);
    }


    // Store Comments for Users
    public function comment_store(Request $request){
         //validator
         $comment_id = Auth::user()->id;
        //$find = userpost::with('user')->find($request->id);
            usercomment::create([
                'user_id'=>$comment_id,
                'userpost_id' => $request->id,
                'comment' => $request->comment,
             ]);

             return response()->json([
                "status"=>true,
                "id"=>$request->id,
                "data"=>$request->comment
            ]);
    }


    // View Profile
    public function profile(){
        $user = Auth::user();
        $posts = userpost::orderBy('created_at','DESC')->get()->where('user_id',Auth::user()->id);

        return view('userdashboard.profile',compact('posts'),['user'=> $user]);

    }

    // View Posts
    public function post(){
        $user = Auth::user();

        //Fetch Advertisement
       $ad = ad::all();

                        // 'user' is the name of Relationship in userpost Modal
        $posts = userpost::with('comments.user')->orderBy('created_at','DESC')->get();
        return view('userdashboard.post',compact('posts','ad'),['user'=> $user]);
    }

}
