<?php

namespace App\Http\Controllers\Main;

use File;
use App\Models\cloth;
use LaravelLocalization;
use App\Traits\photoTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClothsController extends Controller
{

    use photoTrait;

    ################################ Cloths Blade ################################

    public function clothsCreate(){
        $admin = Auth::guard('admin')->user();
        return view('admindashboard.cloths.create',['admin'=>$admin]);
    }

    public function getCloths(){
        $posts = cloth::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','info_'.LaravelLocalization::getCurrentLocale().' as info','photo')->orderBy('created_at','ASC')->get();
       return response()->json(["posts"=>$posts]);
    }

    public function cloths(Request $request){
        $search = $request->input('search');
        $posts = cloth::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','info_'.LaravelLocalization::getCurrentLocale().' as info','photo')->orderBy('created_at','ASC')
        ->where('name_en', 'LIKE', "%{$search}%")
        ->orWhere('info_en', 'LIKE', "%{$search}%")
        ->orWhere('name_ar', 'LIKE', "%{$search}%")
        ->orWhere('info_ar', 'LIKE', "%{$search}%")
        ->get();

        return view("nihonBlade.cloths",compact('posts'));
    }

    ################################ End ################################




    ################################ CRUD ################################

    public function store(Request $request){
        //validation

        $file_name = $this->savephoto($request->photo,'img/cloths');

        cloth::create([
            "name_ar" => $request->name_ar,
            "info_ar" => $request->info_ar,
            "name_en" => $request->name_en,
            "info_en" => $request->info_en,
            "photo" => $file_name,
        ]);

        return response()->json([
            "status"=>true,
            "msg"=>"Cloths Info Created Successfully"
        ]);

    }

    public function edit(Request $request){
        $admin = Auth::guard('admin')->user();
        $cloth_edit = cloth::find($request->cloths_id);
        if(!$cloth_edit)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

        //select from DB
        $cloth_edit = cloth::select('id','name_ar','info_ar','name_en','info_en','photo')->find($request->cloths_id);
        return view('admindashboard.cloths.edit',compact('cloth_edit'),['admin'=>$admin]);
    }

    public function update(Request $request){
        $cloth_update = cloth::find($request->id);
        if(!$cloth_update)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

         //update
         if($request->has('photo')){
            $path = public_path('/img/cloths/'.$food_update->photo);
            if(File::exists($path)){
                File::delete($path);
            }
           $img = $request->file('photo');
           $img_ext = $img->extension();
           $img_name = time().rand(1,4000).'.'.$img_ext;
           $path = 'img/cloths';
           $img ->move($path,$img_name);
        }
        else {
            $img_name = $cloth_update->photo;
        }
        $cloth_update->name_ar = $request->name_ar;
        $cloth_update->info_ar = $request->info_ar;
        $cloth_update->name_en = $request->name_en;
        $cloth_update->info_en = $request->info_en;
        $cloth_update->photo = $img_name;
        $cloth_update->update();

        return response()->json([
            "status"=>true,
            "msg"=>"Update done Successfully"
        ]);
    }

    public function delete(Request $request){
        $cloth_delete = cloth::find($request->id);
        if (!$cloth_delete)
        return response()->json([
            "status"=>false,
            "msg"=>"This id does not exist",
        ]);

        $path = public_path('img/cloth/'.$cloth_delete->photo);
        if(File::exists($path)){
          File::delete($path);
      }
        $cloth_delete->delete();
        return response()->json([
            "status"=>true,
            "msg"=>"Delete done Successfully",
            "id"=>"$request->id"
        ]);
    }


    public function clothsAll(){
        $admin = Auth::guard('admin')->user();
       $all= cloth::select('id','name_ar','info_ar','name_en','info_en','photo')->get();
       return view('admindashboard.cloths.cloths',compact('all'),['admin'=>$admin]);
    }

    ################################ End ################################

}
