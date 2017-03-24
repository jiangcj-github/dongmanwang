<?php

namespace App\Http\Controllers;

use App\Util\Encode;
use App\Util\Random;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

use App\Util\TimeUtil;

class PlayController extends Controller
{


    public function getPlay(Request $request){
        $video_id = $request->input("id");
        if($video_id==null){
            return view("errors/404");
        }
        //video
        $result1 = DB::select("select * from video where id=?", [$video_id]);
        //comment
        $cm_page=$request->input("cm_page",1);
        $result21=DB::select("select count(id) as count from comment");
        $result2 = DB::select("select user_id,text,time,name from comment join member on comment.user_id=member.id where video_id=? ".
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

        return response()->view("play-html5", [
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
        return view("errors/404");
    }

}

