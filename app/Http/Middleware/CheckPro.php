<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;
use League\CommonMark\Reference\Reference;

class CheckPro
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
        $request_url = $_SERVER['REQUEST_URI'];

        $url_hash = substr(md5($request_url),5,10);

        $expire = 60;

        $key = 'access_token_'.$url_hash;

        $token = Redis::get($key);
//        echo $token;die;
        if($token > 9){
            $response = [
                'error' => 50010,
                'msg' => "请求过于频繁，请在 {$expire} 秒后重试"
            ];

            Redis::expire($key,$expire);
            echo json_encode($response,JSON_UNESCAPED_UNICODE);die;
        }else{
                $num = Redis::incr($key);
//                echo '当前访问次数为：'.$num;
            return $next($request);
        }

    }
}
