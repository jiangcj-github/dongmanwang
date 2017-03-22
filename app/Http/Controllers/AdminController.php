<?php

namespace App\Http\Controllers;

use App\Util\Random;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private $USER="lindakai";
    private $PASS="20090928";

    public function uploadVideo(Request $request){
        $id=$request->input("id");

    }

    public function login(Request $request){
        $name=$request->input("name","");
        $pass=$request->input("pass","");
        if($name===$this->USER&&$pass===$this->PASS){
            session(["admin"=>$name]);
            return redirect("/admin/home");
        }else{
            return redirect("/admin")->with("msg","用户名或密码错误");
        }
    }

    public function getHome(Request $request){

        //categery
        $request1=DB::select("select * from video_categery");

        return view("admin/home",[
            "categery"=>$request1
        ]);
    }

    public function admin(Request $request){
        return response()->view("admin/login");
    }

    //
    public function addCategery(Request $request){
        $name=$request->input("name");
        if($name==null){
            return response()->json(["msg"=>"参数错误"]);
        }
        DB::insert("insert into video_categery(name) values(?)",[$name]);
        return response()->json();
    }

    public function deleteCategery(Request $request){
        $id=$request->input("id");
        if($id==null){
            return response()->json(["msg"=>"参数错误"]);
        }
        DB::delete("delete from video_categery where id=?",[$id]);
        return response()->json();
    }

    public function renameCategery(Request $request){
        $id=$request->input("id");
        $newName=$request->input("name");
        if($id==null||$newName==null){
            return response()->json(["msg"=>"参数错误"]);
        }
        DB::update("update video_categery set name=? where id=?",[$newName,$id]);
        return response()->json();
    }

}

