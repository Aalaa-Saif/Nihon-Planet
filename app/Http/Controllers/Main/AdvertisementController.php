<?php

namespace App\Http\Controllers\Main;

use App\Models\ad;
use App\Traits\photoTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Main\AdvertisementController;

class AdvertisementController extends Controller
{
    use photoTrait;


     // View an Advertisement -> to user Post page //
     public function create(){
        $admin = Auth::guard('admin')->user();
        return view('admindashboard.advertisement.create',['admin'=>$admin]);
    }


    // Store an Advertisement -> for user Post page //
    public function store(Request $request){
        //validation

        $file_name = $this->savephoto($request->media,'img/ad');
        ad::create([
            'text'=>$request->text,
            'media'=>$file_name,
        ]);

        return response()->json([
            "status"=>true,
            "msg"=>"Advertisement added successfully",
        ]);
    }


    
    public function edit(Request $request){
        $admin = Auth::guard('admin')->user();
        $ad = ad::find($request->id);
        if(!$ad)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

        //select from DB
        $ad = ad::select('id','text','media')->find($request->id);
        return view('admindashboard.advertisement.edit',compact('ad'),['admin'=>$admin]);
    }

    public function update(Request $request){
        $ad = ad::find($request->id);
        if(!$ad)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

         //update
         if($request->has('media')){
            $path = public_path('/img/ad/'.$ad->media);
            if(File::exists($path)){
                File::delete($path);
            }
           $m = $request->file('media');
           $m_ext = $m->extension();
           $m_name = time().rand(1,4000).'.'.$m_ext;
           $path = 'img/ad';
           $m ->move($path,$m_name);
        }
        else {
            $m_name = $ad->media;
        }
        $ad->text = $request->text;
        $ad->media = $m_name;
        $ad->update();

        return response()->json([
            "status"=>true,
            "msg"=>"Update done Successfully"
        ]);
    }

    public function delete(Request $request){
        $ad = ad::find($request->id);
        if (!$ad)
        return response()->json([
            "status"=>false,
            "msg"=>"This id does not exist",
        ]);

        $path = public_path('img/ad/'.$ad->media);
        if(File::exists($path)){
          File::delete($path);
      }
        $ad->delete();
        return response()->json([
            "status"=>true,
            "msg"=>"Delete done Successfully",
            "id"=>"$request->id"
        ]);
    }


    public function adAll(){
        $admin = Auth::guard('admin')->user();
       $all= ad::select('id','text','media')->get();
       return view('admindashboard.advertisement.ad',compact('all'),['admin'=>$admin]);
    }


}
