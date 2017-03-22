<?php

namespace App\Http\Controllers;

use App\Util\Random;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{

    public function getHeadimg(Request $request)
    {
        $id=$request->input("id");
        //headimg
        $result=DB::select("select * from member_headimg where md5(id)=?",[$id]);
        return response($result[0]->data)->header("Content-Type", $result[0]->mime);
    }

}

