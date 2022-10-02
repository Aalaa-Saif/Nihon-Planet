<?php

namespace App\Http\Controllers\Main;

use Auth;
use App\Models\nihon;
use LaravelLocalization;
use Illuminate\Http\Request;
use App\Http\Requests\adminRequest;
use App\Http\Controllers\Controller;

class NihonController extends Controller
{
    #################### Blade ####################
    public function nihon(){
        return view('nihonBlade.nihon');
    }

    public function getNihon(){
        $gn = nihon::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','info_'.LaravelLocalization::getCurrentLocale().' as info')->get();
        return response()->json(["gn"=>$gn]);
    }



    #################### CRUD ####################

    public function nihonAll(){
        $admin = Auth::guard('admin')->user();
        $all = nihon::all();
        return view('admindashboard.nihon.nihon',compact('all'),['admin'=>$admin]);
    }

    public function nihonStore(adminRequest $request){
        //validation

        nihon::create([
            "name_ar" => $request->name_ar,
            "info_ar" => $request->info_ar,
            "name_en" => $request->name_en,
            "info_en" => $request->info_en,
        ]);

        return response()->json([
            "status"=>true,
            "msg"=>"Nihon Info Created Successfully"
        ]);
    }

    public function nihonCreate(){
        $admin = Auth::guard('admin')->user();
        return view('admindashboard.nihon.create',['admin'=>$admin]);
    }
}
