<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function apireg(Request $request){
        $name = $request->post('user_name');
        $email = $request->post('email');
        $password = $request->post('password');
        $passwordker = $request->post('passwordker');
        if(empty($name) || empty($email) || empty($password) || empty($passwordker)){
            $arr = [
                'code'=>'2000',
                'msg'=>'必填参数不能为空',
            ];
            return $arr;
        }
        $len=strlen($password);
        if($len < 6){
            $arr = [
                'code'=>'2001',
                'msg'=>'密码不能小于六位',
            ];
            return $arr;
        }
        if($password != $passwordker){
            $arr = [
                'code'=>'2002',
                'msg'=>'密码和确认密码请保持一致',
            ];
            return $arr;
        }
        $userModel = new User();
        $u = $userModel::where('user_name',$name)->first();
        if($u){
            $arr = [
                'code'=>'2002',
                'msg'=>'用户名已存在，请更改后重试',
            ];
            return $arr;
        }
        $c = $userModel::where('email',$email)->first();
        if($c){
            $arr = [
                'code'=>'2003',
                'msg'=>'此邮箱已存在',
            ];
            return $arr;
        }
        $data = [
            'user_name'=>$name,
            'email'=>$email,
            'password'=>password_hash($password,PASSWORD_BCRYPT),
        ];
        $res = $userModel->insert($data);
        if($res){
            $arr = [
                'code'=>0,
                'msg'=>'注册成功',
            ];
            return $arr;
        }else{
            $arr = [
                'code'=>'2004',
                'msg'=>'注册失败，请重试',
            ];
            return $arr;
        }
    }


    public function logindo(Request $request){
        $name = $request->post('user_name');
        $password = $request->post('password');
        if(empty($name) || empty($password)){
            $arr = [
                'code'=>'2005',
                'msg'=>'用户名或密码不能为空',
            ];
            return $arr;
        }
        $userModel = new User();
        $v = $userModel::where('user_name',$name)->first();
        if($v){
            $res = password_verify($password,$v->password);
            if($res){
                $str = $v->user_id . $v->user_name . time();
                $token = substr(md5($str),10,16) . substr(md5($str),0,10);
                $data = [
                    'uid' => $v->user_id,
                    'token' => $token,
                ];
                $tokenModel = new Token();
//                $tokenModel->insert($data);

                Redis::set($token,$v->user_id);
                $arr = [
                    'code'=>0,
                    'msg'=>'0k',
                    'token'=>$token,
                ];
                return  $arr;
            }else{
                $arr = [
                    'code'=>'2007',
                    'msg'=>'密码错误',
                ];
                return $arr;
            }
        }else{
            $arr = [
                'code'=>'2006',
                'msg'=>'此用户不存在请在注册之后登录',
            ];
            return $arr;
        }

    }



    public function center(){

        if(isset($_GET['token'])){
            $token = $_GET['token'];
        }else{
            $arr = [
                'code'=>'2008',
                'msg'=>'请先登录',
            ];
            return $arr;
        }
//        存储到数据库
//        $res = Token::where(['token'=>$token])->first();
//        存储的redis;
        $res = Redis::get($token);
        if($res){
            return '欢迎来到个人中心';
        }else{
            $arr = [
                'code'=>'2009',
                'msg'=>'请先登录',
            ];
            return $arr;
        }
    }

    public function order(){


        if(isset($_GET['token'])){
            $token = $_GET['token'];
            $res = Redis::get($token);
            if($res){

            }else{
                $arr = [
                    'code'=>'2009',
                    'msg'=>'请先登录',
                ];
                return $arr;
            }
        }else{
            $arr = [
                'code'=>'2008',
                'msg'=>'请先登录',
            ];
            return $arr;
        }
        $array = [
            '2786783275874265876',
            '8727538275782623224',
            '6576126347432433156',
            '4456126347251463156',
            '7825892983598239483',
        ];

        $arr = [
            'code'=>0,
            'msg'=>'OK',
            'data' => [
                'order' => $array
            ]
        ];
        return $arr;

    }


    public function cart(){


        if(isset($_GET['token'])){
            $token = $_GET['token'];
            $res = Redis::get($token);
            if($res){

            }else{
                $arr = [
                    'code'=>'2009',
                    'msg'=>'请先登录',
                ];
                return $arr;
            }
        }else{
            $arr = [
                'code'=>'2008',
                'msg'=>'请先登录',
            ];
            return $arr;
        }
        $array = [
            123424,
            213214,
            435345
        ];

        $arr = [
            'code'=>0,
            'msg'=>'OK',
            'data' => [
                'order' => $array
            ]
        ];
        return $arr;

    }
}
