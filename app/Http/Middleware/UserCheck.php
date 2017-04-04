<?php

namespace App\Http\Middleware;

use App\Util\Random;
use Illuminate\Support\Facades\DB;
use Closure;

class UserCheck
{
    public function handle($request, Closure $next)
    {
        // 执行动作
        if(!$request->session()->has("user")){
            //未登录,新建随机用户
            do{
                $name=Random::getRandString(10);
                $result1=DB::select("select count(id) as count from member where name=?",[$name]);
            }while($result1[0]->count>0);
            DB::insert("insert into member(name) values(?)",[$name]);
            session(["user"=>$name]);
        }
        return $next($request);
    }

}