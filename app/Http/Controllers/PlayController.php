<?php

namespace App\Http\Controllers;

use App\Util\Random;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class PlayController extends Controller
{

    public function getPlay(Request $request){
        $video_id = $request->input("id");
        $device=session("device","desktop");
        if($video_id==null){
            return response()->view($device."/errors/404");
        }
        //video
        $result1 = DB::select("select * from video where id=?", [$video_id]);
        //comment
        $cm_page=$request->input("cm_page",1);
        $result21=DB::select("select count(id) as count from comment");
        $result2 = DB::select("select comment.*,member.name from comment join member on comment.user_id=member.id where video_id=? ".
            "order by comment.time desc limit ? offset ?",[$video_id,10,($cm_page-1)*10]);
        //video_token
        $video_token = Random::getRandString(20);
        session(["video_token" => $video_token]);
        //play-list
        $play_list=[];
        for($i=0;$i<6;$i++){
            $re=DB::select("select id,duration,name from video join (select rand()*(select max(id) from video) as T) as t2 where id > t2.T order by id asc limit 1");
            $play_list[]=$re[0];
        }
        //push-list
        $push_list=[];
        for($i=0;$i<6;$i++){
            $re=DB::select("select id,name from video join (select rand()*(select max(id) from video) as T) as t2 where id > t2.T order by id asc limit 1");
            $push_list[]=$re[0];
        }

        return response()->view($device."/play-html5", [
            "video" => $result1[0],
            "comment" => $result2,
            "cm_page"=>$cm_page,
            "cm_count"=>$result21[0]->count,
            "video_token" => $video_token,
            "play_list" => $play_list,
            "push_list" => $push_list
        ]);
    }

    public function getMp4(Request $request){
        //比较client_token与server_token是否一致
        $client_token=$request->input("token");
        $server_token=session("video_token",Random::getRandString(20));
        if($server_token==$client_token){
            $request->session()->forget('video_token');
            //apache mod_auth_token
            $secret = "lindakai";
            $protectedPath = "/data/video/mp4/";
            $ipLimitation = true;
            $hexTime = dechex(time());
            $fileName = "/".$request->input("id").".mp4";
            if ($ipLimitation) {
                $token = md5($secret.$fileName.$hexTime.$_SERVER["REMOTE_ADDR"]);
            } else {
                $token = md5($secret.$fileName.$hexTime);
            }
            $url = $protectedPath.$token."/".$hexTime.$fileName;
            return redirect($url);
        }
        $device=session("device","desktop");
        return response()->view($device."/errors/404");
    }

    public function deldir($dir) {
        //先删除目录下的文件：
        $dh=opendir($dir);
        while(false !== ($file = readdir($dh))) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    deldir($fullpath);
                }
            }
        }
        closedir($dh);
        //删除当前文件夹
        rmdir($dir);
    }

    public function getfilecounts($dir){
        $handle = opendir($dir);
        $i = 0;
        while(false !== ($file=readdir($handle))){
            if($file !== "."&& $file != "..") {
                $i++;
            }
        }
        closedir($handle);
        return $i;
    }

    //解决资源同步问题
    public function startCommentHandle(Request $request){
        //清除过期的不成功的上传
        $result1=DB::select("select * from comment_handle");
        foreach ($result1 as $key=>$value){
            $now_time = date("Y-m-d H:i:s", time());
            $now_time = strtotime($now_time);
            $start_time = strtotime($value->start);
            $dur = $now_time - $start_time;
            if($dur>=3600){
                $path="./data/comment/handle/".$value->id;
                if(file_exists($path)){
                    $this->deldir($path);
                }
                DB::delete("delete from comment_handle where id=?",[$value->id]);
            }
        }
        //删除单个会话不成功的上传
        if($request->session()->has("commentHandle")){
            $old_handle=session("commentHandle");
            $this->endCommentHandle($request,$old_handle);
        }
        //分配新的句柄
        DB::insert("insert into comment_handle(start) values(?)",[date("Y-m-d H:i:s", time())]);
        $result2=DB::select("select id from comment_handle order by id desc limit 1");
        $path="./data/comment/handle/".$result2[0]->id;
        if(file_exists($path)){
            $this->deldir($path);
        }
        mkdir($path);
        session(["commentHandle"=>$result2[0]->id]);
        return response()->json(["handle"=>$result2[0]->id]);
    }

    public function endCommentHandle($request,$handle){
        $path="./data/comment/handle/".$handle;
        if(file_exists($path)){
            $this->deldir($path);
        }
        $request->session()->forget("commentHandle");
        DB::delete("delete from comment_handle where id=?",[$handle]);
    }

    public function uploadCommentImage(Request $request){
        $handle=$request->input("handle");
        $file=$request->file("file");
        if ($handle==null||$file==null||!$file->isValid()){
            return response()->json(["msg"=>"invalid"]);
        }else if($file->extension()!="png"){
            return response()->json(["msg"=>"Error Format [".$file->extension()."]"]);
        }
        $newPath="./data/comment/handle/".$handle."/";
        //限制上传次数
        if($this->getfilecounts($newPath) >= 5){
            return response()->json(["msg"=>"上传图片超过最大限制"]);
        }
        $name=Random::getRandString(10);
        while(file_exists($newPath.$name.".png")){
            $name=Random::getRandString(10);
        }
        $file->move($newPath,$name.".png");
        return response()->json(["url"=>"/data/comment/handle/".$handle."/".$name.".png","name"=>$name]);
    }

    public function removeCommentImage(Request $request){
        $handle=$request->input("handle");
        $name=$request->input("name");
        if($handle!=null&&$name!=null){
            $path="./data/comment/handle/".$handle."/".$name.".png";
            if(file_exists($path)){
                unlink($path);
            }
        }
    }

    public function addComment(Request $request){
        $handle=$request->input("handle");
        $text=$request->input("text");
        $video_id=$request->input("video_id");
        $time=date("Y-m-d H:i:s",time());
        //user
        $user=session("user","未知用户");
        $result0=DB::select("select id from member where name=?",[$user]);
        $user_id=$result0[0]->id;
        if($handle!=null){
            $img=$request->input("img");
            DB::insert("insert into comment(video_id,user_id,time,text,img) values(?,?,?,?,?)",[$video_id,$user_id,$time,$text,$img]);
            $result1=DB::select("select id from comment order by id desc limit 1");
            $path="./data/comment/img/".$result1[0]->id;
            if(!file_exists($path)){
                mkdir($path);
            }
            $names=explode("-",$img,-1);
            foreach ($names as $name){
                copy("./data/comment/handle/".$handle."/".$name.".png",$path."/".$name.".png");
            }
            $this->endCommentHandle($request,$handle);
        }else{
            DB::insert("insert into comment(video_id,user_id,time,text) values(?,?,?,?)",[$video_id,$user_id,$time,$text]);
        }
        return redirect("/play?id=".$video_id);
    }

}

