<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
{
    public function handle($request, Closure $next)
    {
        // 执行动作
        if(!$request->session()->has("admin")){
            return redirect("/admin")->with("msg","未登录或登录状态过期");
        }else{
            return $next($request);
        }
    }
}