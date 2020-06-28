<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class CheckPri
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
       $token = $request->input('token');
        $res = Redis::get($token);
        if(!$res){
            $response = [
                'error' => 50009,
                'msg' => '鉴权失败'
            ];
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
            die;
        }

        return $next($request);
    }
}
