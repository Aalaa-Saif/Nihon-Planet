<?php

namespace App\Http\Controllers\Main;

use File;
use LaravelLocalization;
use App\Models\city;
use App\Models\food;
use App\Models\nihon;
use App\Models\cityimg;
use App\Traits\photoTrait;
use Illuminate\Http\Request;
use App\Http\Requests\adminRequest;
use App\Http\Requests\photoRequest;
use App\Http\Controllers\Controller;

class ClothsController extends Controller
{

    use photoTrait;

    ################################ Cloths Blade ################################

    public function clothsCreate(){
        $admin = Auth::guard('admin')->user();
        return view('admindashboard.cloths.create',['admin'=>$admin]);
    }

    public function getCloths(){
        //$gf = food::all();
        $gf = cloth::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','photo')->get();
        return response()->json(["gf"=>$gf]);
    }

    public function cloths(){
        return view("nihonBlade.cloths");
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
            "msg"=>"Food Info Created Successfully"
        ]);

    }

    public function edit(Request $request){
        $admin = Auth::guard('admin')->user();
        $food_edit = food::find($request->food_id);
        if(!$food_edit)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

        //select from DB
        $food_edit = food::select('id','name_ar','info_ar','name_en','info_en','photo')->find($request->food_id);
        return view('admindashboard.food.edit',compact('food_edit'),['admin'=>$admin]);
    }

    public function update(Request $request){
        $food_update = food::find($request->id);
        if(!$food_update)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

         //update
         if($request->has('photo')){
            $path = public_path('/img/food/'.$food_update->photo);
            if(File::exists($path)){
                File::delete($path);
            }
           $img = $request->file('photo');
           $img_ext = $img->extension();
           $img_name = time().rand(1,4000).'.'.$img_ext;
           $path = 'img/food';
           $img ->move($path,$img_name);
        }
        else {
            $img_name = $food_update->photo;
        }
        $food_update->name_ar = $request->name_ar;
        $food_update->info_ar = $request->info_ar;
        $food_update->name_en = $request->name_en;
        $food_update->info_en = $request->info_en;
        $food_update->photo = $img_name;
        $food_update->update();

        return response()->json([
            "status"=>true,
            "msg"=>"Update done Successfully"
        ]);
    }

    public function delete(Request $request){
        $food_delete = food::find($request->id);
        if (!$food_delete)
        return response()->json([
            "status"=>false,
            "msg"=>"This id does not exist",
        ]);

        $path = public_path('img/food/'.$food_delete->photo);
        if(File::exists($path)){
          File::delete($path);
      }
        $food_delete->delete();
        return response()->json([
            "status"=>true,
            "msg"=>"Delete done Successfully",
            "id"=>"$request->id"
        ]);
    }


    public function clothsAll(){
        $admin = Auth::guard('admin')->user();
       $all= food::select('id','name_ar','info_ar','name_en','info_en','photo')->get();
       return view('admindashboard.food.food',compact('all'),['admin'=>$admin]);
    }

    ################################ End ################################

}
