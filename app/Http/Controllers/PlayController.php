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
        $video_id = $request->input("id",md5(1));
        //video
        $result1 = DB::select("select * from video where md5(id)=?", [$video_id]);
        $video=$result1[0];
        $video->id=md5($video->id);
        $video->url=Encode::encode($video->url);
        $video->poster=md5($video->poster);
        $video->screenshot=md5($video->screenshot);
        //comment
        $result2 = DB::select("select comment.*,member.headimg,member.name from comment join member on comment.user_id=member.id where md5(video_id)=? order by comment.time desc limit 10", [$video_id]);
        foreach ($result2 as $key=>$value){
            $result2[$key]->headimg=md5($value->headimg);
            $result2[$key]->time=TimeUtil::time_tran($value->time);
        }
        //video_token
        $video_token = Random::getRandString(20);
        session(["video_token" => $video_token]);
        //play-list
        $play_list=[];
        for($i=0;$i<6;$i++){
            $re=DB::select("select id,duration,screenshot,name from video join (select rand()*(select max(id) from video) as T) as t2 where id > t2.T order by id asc limit 1");
            $re[0]->id=md5($re[0]->id);
            $re[0]->screenshot=md5($re[0]->screenshot);
            $play_list[]=$re[0];
        }
        //push-list
        $push_list=[];
        for($i=0;$i<6;$i++){
            $re=DB::select("select id,poster,name from video join (select rand()*(select max(id) from video) as T) as t2 where id > t2.T order by id asc limit 1");
            $re[0]->id=md5($re[0]->id);
            $re[0]->poster=md5($re[0]->poster);
            $push_list[]=$re[0];
        }

        return response()->view("play-html5", [
            "video" => $result1[0],
            "comment" => $result2,
            "video_token" => $video_token,
            "play_list" => $play_list,
            "push_list" => $push_list
        ]);
    }

    public function getVideo(Request $request){
        //比较client_token与server_token是否一致
        $client_token=$request->input("token");
        $server_token=session("video_token",Random::getRandString(20));
        if($server_token==$client_token){
            $request->session()->forget('video_token');
            //apache mod_auth_token
            $secret = "lindakai";
            $protectedPath = "/mv/";
            $ipLimitation = true;
            $hexTime = dechex(time());
            $fileName = "/".Encode::decode($request->input("file"));
            if ($ipLimitation) {
                $token = md5($secret.$fileName.$hexTime.$_SERVER["REMOTE_ADDR"]);
            } else {
                $token = md5($secret.$fileName.$hexTime);
            }
            $url = $protectedPath.$token."/".$hexTime.$fileName;
            return redirect($url);
        }
        return "404 Not Found";
    }

    public function getPoster(Request $request){
        $id = $request->input("id",md5(1));
        //poster
        $result = DB::select("select * from video_poster where md5(id)=?", [$id]);
        return response($result[0]->data)->header("Content-Type", $result[0]->mime);
    }

    public function getScreenShot(Request $request){
        $id = $request->input("id",md5(1));
        //screenshot
        $result = DB::select("select * from video_screenshot where md5(id)=?", [$id]);
        return response($result[0]->data)->header("Content-Type", $result[0]->mime);
    }

}

