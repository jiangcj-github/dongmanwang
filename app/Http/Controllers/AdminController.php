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
        $limit=$request->input("cat_limit",20);
        $offset=$request->input("cat_offset",0);
        //categery
        $result1=DB::select("select * from video_categery limit ? offset ?",[$limit,$offset]);
        $result2=DB::select("select count(*) as count from video_categery");
        return view("admin/home",[
            "categery"=>$result1,
            "cat_limit"=>$limit,
            "cat_offset"=>$offset,
            "cat_count"=>$result2[0]->count
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
        $result1=DB::select("select count(*) as count from video where categery=?",[$id]);
        if($result1[0]->count>0){
            return response()->json(["msg"=>"无法删除，该类型下有".$result1[0]->count."个视频"]);
        }
        DB::delete("delete from video_categery where id=?",[$id]);
        return response()->json();
    }

    public function deleteCategerys(Request $request){
        $id_str=$request->input("ids");
        if($id_str==null){
            return response()->json(["msg"=>"参数错误"]);
        }
        $ids=explode("-",$id_str);
        foreach ($ids as $id){
            $result1=DB::select("select count(*) as count from video where categery=?",[$id]);
            if($result1[0]->count<=0){
                DB::delete("delete from video_categery where id=?",[$id]);
            }
        }
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

    public function uploadPoster(Request $resquest){

        return response()->json(["url"=>"/img/1.jpg"]);
    }

    public function uploadVideo(Request $resquest){

        return response()->json(["url"=>"/img/m_guochan.jpg"]);
    }

    public function getVideoList(){

        return view("admin/video-list");
    }
}

