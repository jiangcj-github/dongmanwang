<?php

namespace App\Http\Controllers;

use App\Util\FfmpegUtil;
use App\Util\Random;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;


//网站管理的controller，只限于Desktop

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

    //------------------------------------------------------------------------------------------------------------------
    public function getHome(Request $request){
        //categery
        $cat_page=$request->input("cat_page",1);
        $result1=DB::select("select * from video_categery limit ? offset ?",[10,($cat_page-1)*10]);
        $result11=DB::select("select count(id) as count from video_categery");
        $result2=DB::select("select * from video_categery");
        //
        return response()->view("/admin/home",[
            "categery"=>$result1,
            "categerys"=>$result2,
            "cat_page"=>$cat_page,
            "cat_count"=>$result11[0]->count
        ]);
    }

    public function admin(Request $request){
        return response()->view("/admin/login");
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

    //upload非原子性，只能同时允许一个用户上传
    public function uploadPoster(Request $request){
        $file = $request->file("file");
        if ($file==null||!$file->isValid()){
            return response()->json(["msg"=>"invalid"]);
        }else if($file->extension()!="png"){
            return response()->json(["msg"=>"Error Format [".$file->extension()."]"]);
        }
        //当前目录public
        $newPath="./data/video/poster/";
        $result1=DB::select("select table_seq from seq where table_name=?",["video"]);
        $newFile=$result1[0]->table_seq.".png";
        $newFilePath=$newPath.$newFile;
        if(file_exists($newFilePath)){
            unlink($newFilePath);
        }
        $file->move($newPath,$newFile);
        return response()->json(["url"=>"/data/video/poster/".$result1[0]->table_seq.".png"]);
    }

    public function uploadVideo(Request $request){
        $file = $request->file("file");
        if ($file==null||!$file->isValid()){
            return response()->json(["msg"=>"invalid"]);
        }else if($file->extension()!="mp4"){
            return response()->json(["msg"=>"Error Format [".$file->extension()."]"]);
        }
        //当前目录public
        $newPath="./data/video/mp4/";
        $result1=DB::select("select table_seq from seq where table_name=?",["video"]);
        $newFile=$result1[0]->table_seq.".mp4";
        $newFilePath=$newPath.$newFile;
        if(file_exists($newFilePath)){
            unlink($newFilePath);
        }
        $file->move($newPath,$newFile);
        //
        $frame_path="./data/video/frame/".$result1[0]->table_seq.".png";
        FfmpegUtil::video_frame("ffmpeg",$newFilePath,$frame_path);
        return response()->json(["url"=>"/data/video/frame/".$result1[0]->table_seq.".png"]);
    }

    public function addVideo(Request $request){
        $name=$request->input("name");
        $firstshow=$request->input("firstshow");
        $nation=$request->input("nation");
        $categery=$request->input("categery");
        $author=$request->input("author");
        if($name==null||$firstshow==null||$nation==null||$categery==null||$author==null){
            return response()->json(["msg"=>"部分参数为空"]);
        }
        $result1=DB::select("select table_seq from seq where table_name=?",["video"]);
        $videoFile="./data/video/mp4/".$result1[0]->table_seq.".mp4";
        if(!file_exists($videoFile)||!file_exists("./data/video/poster/".$result1[0]->table_seq.".png")){
            return response()->json(["msg"=>"Poster或Video未上传"]);
        }
        $info=FfmpegUtil::video_info("ffmpeg",$videoFile);
        $duration=$info["duration"];
        DB::insert("insert into video(id,name,duration,firstshow,nation,author,categery,node) values(?,?,?,?,?,?,?,?)",[$result1[0]->table_seq,$name,$duration,$firstshow,$nation,$author,$categery,config("custom.node_name")]);
        DB::update("update seq set table_seq=? where table_name=?",[$result1[0]->table_seq+1,"video"]);
    }

    //------------------------------------------------------------------------------------------------------------------
    public function getVideoManage(Request $request){
        //video
        $v_page=$request->input("v_page",1);
        $srch_cat=$request->input("srch_cat",-1);
        if($srch_cat==-1){
            $result1=DB::select("select video.*,video_categery.name as cat_name from video join video_categery on video.categery=video_categery.id ".
                "limit ? offset ?",[20,($v_page-1)*20]);
        }else{
            $result1=DB::select("select video.*,video_categery.name as cat_name from video join video_categery on video.categery=video_categery.id ".
                "where video.categery=? limit ? offset ?",[$srch_cat,20,($v_page-1)*20]);
        }
        $result11=DB::select("select count(id) as count from video");
        //categery
        $result2=DB::select("select * from video_categery");

        return response()->view("/admin/video",[
            "video"=>$result1,
            "v_page"=>$v_page,
            "v_count"=>$result11[0]->count,
            "categery"=>$result2,
            "srch_cat"=>$srch_cat
        ]);
    }

    public function deleteV(Request $request){
        $id=$request->input("id");
        if($id==null){
            return response()->json(["msg"=>"参数错误"]);
        }
        $posterFile="./data/video/poster/".$id.".png";
        unlink($posterFile);
        $videoFile="./data/video/mp4/".$id.".mp4";
        unlink($videoFile);
        $videoFrame="./data/video/frame/".$id.".png";
        unlink($videoFrame);
        DB::delete("delete from video where id=?",[$id]);
    }

    public function deleteVs(Request $request){
        $id_str=$request->input("ids");
        if($id_str==null){
            return response()->json(["msg"=>"参数错误"]);
        }
        $ids=explode("-",$id_str);
        foreach ($ids as $id){
            $posterFile="./data/video/poster/".$id.".png";
            unlink($posterFile);
            $videoFile="./data/video/mp4/".$id.".mp4";
            unlink($videoFile);
            $videoFrame="./data/video/frame/".$id.".png";
            unlink($videoFrame);
            DB::delete("delete from video where id=?",[$id]);
        }
        return response()->json(["msg"=>"ok"]);
    }

    public function getVideoUpdate(Request $request){
        $id=$request->input("id");
        $result1=DB::select("select * from video where id=?",[$id]);
        $video=$result1[0];
        $ymd=explode("-",$video->firstshow);
        $result2=DB::select("select * from video_categery");

        return response()->view("/admin/video-update",[
            "video"=>$result1[0],
            "ymd"=>$ymd,
            "categerys"=>$result2
        ]);
    }

    public function uploadPoster2(Request $request){
        $id=$request->input("id");
        $file = $request->file("file");
        if ($file==null||!$file->isValid()){
            return response()->json(["msg"=>"upload invalid"]);
        }else if($file->extension()!="png"){
            return response()->json(["msg"=>"Error Format [".$file->extension()."]"]);
        }
        //当前目录public
        $newPath="./data/video/poster/";
        $newFile=$id.".png";
        $newFilePath=$newPath.$newFile;
        if(file_exists($newFilePath)){
            unlink($newFilePath);
        }
        $file->move($newPath,$newFile);
        return response()->json(["url"=>"/data/video/poster/".$id.".png"]);
    }

    public function uploadVideo2(Request $request){
        $id=$request->input("id");
        $file = $request->file("file");
        if ($file==null||!$file->isValid()){
            return response()->json(["msg"=>"invalid"]);
        }else if($file->extension()!="mp4"){
            return response()->json(["msg"=>"Error Format [".$file->extension()."]"]);
        }
        //当前目录public
        $newPath="./data/video/mp4/";
        $newFile=$id.".mp4";
        $newFilePath=$newPath.$newFile;
        if(file_exists($newFilePath)){
            unlink($newFilePath);
        }
        $file->move($newPath,$newFile);
        //
        $frame_path="./data/video/frame/".$id.".png";
        FfmpegUtil::video_frame("ffmpeg",$newFilePath,$frame_path);
        return response()->json(["url"=>"/data/video/frame/".$id.".mp4"]);
    }

    public function updateVideo(Request $request){
        $id=$request->input("id",4);
        $name=$request->input("name");
        $firstshow=$request->input("firstshow");
        $nation=$request->input("nation");
        $categery=$request->input("categery");
        $author=$request->input("author");
        if($name==null||$firstshow==null||$nation==null||$categery==null||$author==null){
            return response()->json(["msg"=>"部分参数为空"]);
        }
        $videoFile="./data/video/mp4/".$id.".mp4";
        if(!file_exists($videoFile)||!file_exists("./data/video/poster/".$id.".png")){
            return response()->json(["msg"=>"Poster或Video未上传"]);
        }
        $info=FfmpegUtil::video_info("ffmpeg",$videoFile);
        $duration=$info["duration"];
        DB::update("update video set name=?,duration=?,firstshow=?,nation=?,author=?,categery=? where id=?",[$name,$duration,$firstshow,$nation,$author,$categery,$id]);
    }

    public function updateVideoFrame(Request $request){
        $id=$request->input("id");
        $per=$request->input("per");
        $video_path="./data/video/mp4/".$id.".mp4";
        $frame_path="./data/video/frame/".$id.".png";
        FfmpegUtil::video_frame_by_per("ffmpeg",$video_path,$frame_path,$per);
        return response()->json(["url"=>"/data/video/frame/".$id.".png"]);
    }


}



