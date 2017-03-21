<?php

namespace App\Http\Controllers;

use App\Util\Random;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

use App\Util\TimeUtil;

class PlayController extends BaseController
{


    public function getPlay(Request $request){
        $video_id = $request->input("video",md5(1));
        //video
        $result1 = DB::select("select * from video where md5(id)=?", [$video_id]);
        if (count($result1) == 0){
            return response()->view("errors/404");
        }
        $video=$result1[0];
        $video->id=md5($video->id);
        //comment
        $result2 = DB::select("select comment.*,member.headimg,member.name from comment join member on comment.user_id=member.id where md5(video_id)=? order by comment.time desc limit 10", [$video_id]);
        foreach ($result2 as $key=>$value){
            $result2[$key]->headimg=md5($value->headimg);
            $result2[$key]->time=TimeUtil::time_tran($value->time);
        }
        //video_token
        $video_token = Random::getRandString(20);
        session(["video_token" => $video_token]);

        return response()->view("play-html5", [
            "video" => $result1[0],
            "comment" => $result2,
            "video_token" => $video_token
        ]);
    }

    public function getVideo(Request $request){
        $video_id=$request->input("id");
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
            //filename
            $result=DB::select("select url from video where md5(id)=?",[$video_id]);
            if(count($result)==0){
                return "404 Not Found";
            }
            $fileName = "/".$result[0]->url;
            //
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

}

