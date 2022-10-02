<?php

namespace App\Http\Controllers\Main;

use File;
use App\Models\city;
use App\Models\nihon;
use App\Models\cityimg;
use LaravelLocalization;
use Illuminate\Http\Request;
use App\Http\Requests\adminRequest;
use App\Http\Requests\photoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{


    ################################ City Blade ################################
    public function getCity(){
        $gc = city::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','info_'.LaravelLocalization::getCurrentLocale().' as info','photo')->get();
        return response()->json(["gc"=>$gc]);
    }

    public function cityCreate(){
        $admin = Auth::guard('admin')->user();
        return view('admindashboard.city.create',['admin'=>$admin]);
    }

    public function city(){
        return view('nihonBlade.city');
    }
    ################################ End ################################


    ################################ CRUD ################################
    public function store(Request $request){
        //validation

        $new_city = city::create([
            "name_ar" => $request->name_ar,
            "info_ar" => $request->info_ar,
            "name_en" => $request->name_en,
            "info_en" => $request->info_en,
        ]);

        if($request->has('image')){
            foreach($request->file('image') as $img){
                $img_ext = $img->extension();
                $img_name = time().rand(1,4000).'.'.$img_ext;
                $path = 'img/city';
                $img ->move($path,$img_name);

                cityimg::create([
                    'city_id' => $new_city->id,
                    'image' => $img_name
                ]);
            }
        }
        return response()->json([
            "status"=>true,
            "msg"=>"City Info Created Successfully"
        ]);

    }

    public function edit(Request $request){
        $admin = Auth::guard('admin')->user();
        $city_edit = city::find($request->city_id);
        if(!$city_edit)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

        //select from DB
        $city_edit = city::all()->find($request->city_id);
        return view('admindashboard.city.edit',compact('city_edit'),['admin'=>$admin]);
    }

    public function update(Request $request){
        $city = city::find($request->id);
        $input = $request->all();
        if(!$city)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

        //update
        if($request->has('image')){
            foreach($request->file('image') as $img){
                $img_ext = $img->extension();
                $img_name = time().rand(1,4000).'.'.$img_ext;
                $path = 'img/city';
                $img ->move($path,$img_name);

                cityimg::create([
                    'city_id' => $city->id,
                    'image' => $img_name
                ]);
            }

        }
        $city->update($input);

        return response()->json([
            "status"=>true,
            "msg"=>"Update done Successfully"
        ]);
    }

    public function delete(Request $request){
        $city_delete = city::find($request->id);
        if (!$city_delete)
        return response()->json([
            "status"=>false,
            "msg"=>"This id does not exist",
        ]);
            foreach($city_delete->images as $img){
                //$try = $city_delete->images[0]->$img;
                $path = public_path('img/city/'.$img->image);
                if(File::exists($path)){
                 File::delete($path);
                }
            }
        //return dd($path);
        //$try = $city_delete->images[0]['image'];
        //$path = public_path('img/city/'.$city_delete->images[0]->image);
        $city_delete->delete();
        $city_delete->images()->delete();
        return response()->json([
            "status"=>true,
            "msg"=>"Delete done Successfully",
            "id"=>$request->id
        ]);
    }

    public function city_deleteimg(Request $request){
        $cityimg = cityimg::find($request->id);
        if(!$cityimg)
        return response()->json([
            "status"=>false,
            "msg"=>"image does not delete"
        ]);


            //$try = $city_delete->images[0]->$img;
            $path = public_path('img/city/'.$cityimg->image);
            if(File::exists($path)){
                File::delete($path);
            }

        //return dd($path);

          $cityimg->delete();
          //$cityimg->images()->delete();

         return response()->json([
            "status"=>true,
            "msg"=>"image delete",
            "id"=>$request->id
        ]);
     }

    public function cityAll(){
       $admin = Auth::guard('admin')->user();
       $all= city::all();
       return view('admindashboard.city.city',compact('all'),['admin'=>$admin]);
    }

    ################################ End ################################
}
