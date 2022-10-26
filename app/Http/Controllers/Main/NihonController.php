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
        $nihon = nihon::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','info_'.LaravelLocalization::getCurrentLocale().' as info')->orderBy('created_at','ASC')->get();
        return view('nihonBlade.nihon',compact('nihon'));
    }

    public function getNihon(){
        $gn = nihon::select('id','name_'.LaravelLocalization::getCurrentLocale().' as name','info_'.LaravelLocalization::getCurrentLocale().' as info')->orderBy('created_at','ASC')->get();
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



    public function edit(Request $request){
        $admin = Auth::guard('admin')->user();
        $nihon = nihon::find($request->id);
        if(!$nihon)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);

        //select from DB
        $nihon = nihon::select('id','name_ar','info_ar','name_en','info_en')->find($request->id);
        return view('admindashboard.nihon.edit',compact('nihon'),['admin'=>$admin]);
    }

    public function update(Request $request){
        $nihon = nihon::find($request->id);
        if(!$nihon)
        return response()->json([
            "status"=>false,
            "msg"=>"ID not Found"
        ]);


        $nihon->name_ar = $request->name_ar;
        $nihon->info_ar = $request->info_ar;
        $nihon->name_en = $request->name_en;
        $nihon->info_en = $request->info_en;
        $nihon->update();

        return response()->json([
            "status"=>true,
            "msg"=>"Update done Successfully"
        ]);
    }

    public function delete(Request $request){
        $nihon = nihon::find($request->id);
        if (!$nihon)
        return response()->json([
            "status"=>false,
            "msg"=>"This id does not exist",
        ]);


        $nihon->delete();
        return response()->json([
            "status"=>true,
            "msg"=>"Delete done Successfully",
            "id"=>"$request->id"
        ]);
    }
}
