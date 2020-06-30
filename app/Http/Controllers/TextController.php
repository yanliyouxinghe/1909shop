<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class TextController extends Controller
{
    public function text(){
        $key = 'thisiskey';
        $data = 'thislisdata';
        $sing = sha1($key.$data);
        echo $sing;echo "</br>";

        $b_url = 'http://www.1910.com/text?data='.$data.'&sing='.$sing;
        echo $b_url;
    }
//aebb269f1793d570326faf896380ca3fb1e4fb9b1f6d807744f610983688ab9a0e31c84134f5cb7d


    public function sing(){
        $key = 'thisiskey';
        $data = $_GET['data'];
        echo $data;echo "</br>";
        $sing = $_GET['sing'];
        echo $sing;echo "</br>";


        $lact_sing = sha1($key.$data);
        echo $lact_sing;echo "</br>";
//        echo $sing;die;
        if($lact_sing == $sing){
            echo '签名验证成功';
        }else{
            echo '签名验证失败';
        }

    }



    public function receive(){
        $name = 'lisi';
        $age = '20';
        $sex = '男';
        $url = "http://api.1910.com/api/text1?name=.$name.&age=.$age.&sex=.$sex.";
        $res = file_get_contents($url);
        echo $res;


    }

    public function receive_post(){
        $key = 'secret';
        $data = [
            'name'=>'张三',
            'age'=>'20',
            'sex'=>'男',
            'sajkjsa'=>'sb',
        ];
        $str = json_encode($data).$key;
        $sing = sha1($str);

        $send_data = [
            'data' => json_encode($data),
            'sing' => $sing
        ];

        $url = "http://api.1910.com/api/text2";

//                实例
        $ch = curl_init();
//          配置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$send_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);


//        发送请求
        curl_exec($ch);
//        检测错误
        $errno = curl_errno($ch);
        $errmsg = curl_error($ch);

        if($errno){
            var_dump($errmsg);die;
        }

        curl_close($ch);
    }




    public function enctype1(){
        $data = '长江长江，我是黄河';
        $method = 'AES-256-CBC';
        $key = '1910API';
        $iv = '67ds6f7s6d7df67s';


        $enc_data = openssl_encrypt($data,$method,$key,OPENSSL_RAW_DATA,$iv);
        $sing = sha1($enc_data).$key;
        $post_data = [
            'data'=>$enc_data,
            'sing'=>$sing
        ];
//        $dec_data = openssl_decrypt($enc_data,$method,$key,OPENSSL_RAW_DATA,$iv);
//        var_dump($dec_data);die;
        $url = "http://api.1910.com/api/decrypt1";
        $ch = curl_init();

        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

        $responer = curl_exec($ch);
        $errno = curl_errno($ch);
        $errmsg = curl_error($ch);

        if($errno){
            var_dump($errmsg);die;
        }

        curl_close($ch);
        echo $responer;
    }
}
























