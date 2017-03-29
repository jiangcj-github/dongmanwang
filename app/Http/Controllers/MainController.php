<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function getMain(Request $request){

        return response()->view("main");
    }


    public function getCategery(Request $request){
        $id=$request->input("id");
        $result1=DB::select("select * from video_categery where id=?",[$id]);
        $result2=DB::select("select * from video where categery=?",[$id]);

        return view("categery",[
            "categery"=>$result1[0],
            "videos"=>$result2
        ]);

    }

    public function getSearch(Request $request){
        $key=$request->input("key");
        $searchs=[];
        return view("search",[
           "searchs"=>$searchs
        ]);
    }

}
