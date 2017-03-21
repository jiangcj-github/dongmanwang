<?php

namespace App\Http\Controllers;

use App\Util\Random;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends BaseController
{

    public function getHeadimg(Request $request)
    {
        $headimg_id=$request->input("id");
        //headimg
        $result=DB::select("select * from member_headimg where md5(id)=?",[$headimg_id]);
        if(count($result)==0){
            return "404 Not Found";
        }
        $headimg=$result[0];
        return response($headimg->data)->header("Content-Type", $headimg->mime);
    }

}

