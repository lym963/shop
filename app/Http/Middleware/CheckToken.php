<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $access_token=request()->input("access_token");
        //判断不为空
        if(empty($access_token)){
            $response = [
                'error' => 50001,
                'msg'   => "参数缺失"
            ];
            return response()->json($response);
        }
        $user_id=Redis::get($access_token);
        if(!$user_id){
            $response = [
                'error' => 10000,
                'msg'   => "鉴权失败"
            ];
            return response()->json($response);
        }
        return $next($request);
    }
}
