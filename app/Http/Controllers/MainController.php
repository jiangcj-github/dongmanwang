<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function getMain(Request $request){

        $device=session("device","desktop");
        return response()->view($device."/main/home");
    }

    public function clearDevice(Request $request){
        session()->forget("device");
    }

    public function confirmDevice(Request $request){
        $deviceWidth=$request->input("deviceWidth",800);
        if($deviceWidth>=800){
            session(["device"=>"desktop"]);
        }else{
            session(["device"=>"mobile"]);
        }
        return redirect()->back();
    }

    public function getCategery(Request $request){
        $id=$request->input("id");
        $cat_page=$request->input("cat_page",1);
        $result1=DB::select("select * from video_categery where id=?",[$id]);
        $result2=DB::select("select * from video where categery=? limit ? offset ?",[$id,20,($cat_page-1)*20]);
        $result3=DB::select("select count(id) as cat_count from video where categery=?",[$id]);
        $device=session("device","desktop");
        return response()->view($device."/main/categery",[
            "cat_page"=>$cat_page,
            "cat_count"=>$result3[0]->cat_count,
            "categery"=>$result1[0],
            "videos"=>$result2
        ]);
    }

    public function getSearch(Request $request){
        $key=$request->input("key");
        $device=session("device","desktop");
        if($key==null||$key==""){
            return response()->view($device."/errors/404");
        }
        $searchs=[];
        $len=mb_strlen($key);
        //name
        $result1=[];
        for($l=$len;$l>0;$l--){
            for($s=0;$s<=$len-$l;$s++){
                $result1+=DB::select("select * from video where name like ?",["%".mb_substr($key,$s,$l)."%"]);
            }
            if(count($result1)>=10){
                break;
            }
        }
        $searchs["查询 \"".$key."\" 的结果"]=$result1;
        //author
        $result2=[];
        for($l=$len;$l>0;$l--){
            for($s=0;$s<=$len-$l;$s++){
                $result2+=DB::select("select * from video where author like ?",["%".mb_substr($key,$s,$l)."%"]);
            }
            foreach($result1 as $k=>$v){
                foreach($result2 as $k2=>$v2){
                    if($v2->id==$v->id){
                        unset($result2[$k2]);
                    }
                }
            }
            if(count($result2)>=10){
                break;
            }
        }
        $searchs["相关查询结果1"]=$result2;
        //categery
        $result3=[];
        for($l=$len;$l>0;$l--){
            for($s=0;$s<=$len-$l;$s++){
                $result3+=DB::select("select video.* from video join video_categery on video.categery=video_categery.id ".
                    "where video_categery.name like ?",["%".mb_substr($key,$s,$l)."%"]);
            }
            foreach($result1 as $k=>$v){
                foreach($result3 as $k2=>$v2){
                    if($v2->id==$v->id){
                        unset($result3[$k2]);
                    }
                }
            }
            foreach($result2 as $k=>$v){
                foreach($result3 as $key2=>$v2){
                    if($v2->id==$v->id){
                        unset($result3[$key2]);
                    }
                }
            }
            if(count($result3)>=10){
                break;
            }
        }
        $searchs["相关查询结果2"]=$result3;
        //nation
        $result4=[];
        for($l=$len;$l>0;$l--){
            for($s=0;$s<=$len-$l;$s++){
                $result4+=DB::select("select * from video where nation like ?",["%".mb_substr($key,$s,$l)."%"]);
            }
            foreach($result1 as $k=>$v){
                foreach($result4 as $k2=>$v2){
                    if($v2->id==$v->id){
                        unset($result4[$k2]);
                    }
                }
            }
            foreach($result2 as $k=>$v){
                foreach($result4 as $k2=>$v2){
                    if($v2->id==$v->id){
                        unset($result4[$k2]);
                    }
                }
            }
            foreach($result3 as $k=>$v){
                foreach($result4 as $k2=>$v2){
                    if($v2->id==$v->id){
                        unset($result4[$k2]);
                    }
                }
            }
            if(count($result4)>=10){
                break;
            }
        }
        $searchs["相关查询结果3"]=$result4;
        return response()->view($device."/search",[
            "srch_key"=>$key,
           "searchs"=>$searchs
        ]);
    }

}
