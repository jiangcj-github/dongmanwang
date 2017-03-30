<?php

namespace App\Http\Middleware;

use Closure;

class DeviceAdapter
{
    public function handle($request, Closure $next)
    {
        // 执行动作
        if(!$request->session()->has("device")){
            return response()->view("loading");
        }else{
            return $next($request);
        }
    }
}