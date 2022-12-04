<?php

namespace App\Http\Controllers\AuthController\User;

use Session;
use messages;
use File;
use App\Models\ad;
use App\Models\User;
use App\Models\VerifyUser;
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
    public function profile(Request $request){
        $user = Auth::user();
        $search = $request->input('search');
        $pos = userpost::orderBy('created_at','DESC')->where('user_id',Auth::user()->id);
        $posts = $pos
        ->where('text', 'LIKE', "%{$search}%")
        ->get();
        return view('userdashboard.profile',compact('posts'),['user'=> $user]);

    }

    // View Posts
    public function post(Request $request){
        $user = Auth::user();
        $search = $request->input('search');
        //Fetch Advertisement
       $ad = ad::all();

                        // 'user' is the name of Relationship in userpost Modal
        //$posts = userpost::with('comments.user')->orderBy('created_at','DESC')->get();
        $posts = userpost::with('comments.user')->orderBy('created_at','DESC')
        ->where('text', 'LIKE', "%{$search}%")
        ->get();
        return view('userdashboard.post',compact('posts','ad'),['user'=> $user]);
    }

    public function delete(Request $request){
        $delete = userpost::find($request->id);
        if (!$delete)
        return response()->json([
            "status"=>false,
        ]);
            foreach($delete->userpostimgs as $img){
                $path = public_path('img/userpostimg/'.$img->image);
                if(File::exists($path)){
                 File::delete($path);
                }
            }

        $delete->delete();
        $delete->userpostimgs()->delete();
        return response()->json([
            "status"=>true,
            "id"=>$request->id
        ]);
    }

     // update profile
     public function updateUserProfile(Request $request){
        $profile_update = User::find($request->id);
        if(!$profile_update)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

         //update
         if($request->has('photo')){
            $path = public_path('/img/userimg/'.$profile_update->photo);
            if(File::exists($path)){
                File::delete($path);
            }
           $img = $request->file('photo');
           $img_ext = $img->extension();
           $img_name = time().rand(1,4000).'.'.$img_ext;
           $path = 'img/userimg';
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
            "msg"=>__('messages.userUpdateProfileSuccessfully')
        ]);
    }

}
