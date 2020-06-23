<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
class UserController extends Controller
{
    public function reg(){
        return view('user.reg');
    }

    public function regdo(Request $request){
       $name = $request->post('user_name');
       $email = $request->post('email');
        $password = $request->post('password');
        $passwordker = $request->post('passwordker');
        if(empty($name) || empty($email) || empty($password) || empty($passwordker)){
               return redirect('/user/reg')->with('msg','必须参数不能为空');
        }
        $len=strlen($password);
        if($len < 6){
            return redirect('/user/reg')->with('msg','密码不能小于六位');
        }
        if($password != $passwordker){
            return redirect('/user/reg')->with('msg','密码和确认密码请保持一致');
        }
        $userModel = new User();
        $u = $userModel::where('user_name',$name)->first();
        if($u){
            return redirect('/user/reg')->with('msg','用户名已存在，请更改后重试');
        }
        $c = $userModel::where('email',$email)->first();
        if($c){
            return redirect('/user/reg')->with('msg','此邮箱已存在');
        }
        $data = [
            'user_name'=>$name,
            'email'=>$email,
            'password'=>password_hash($password,PASSWORD_BCRYPT),
        ];
        $res = $userModel->insert($data);
        if($res){
            return redirect('/user/login')->with('msg','注册成功，请登录');
        }else{
            return redirect('/user/reg')->with('msg','注册失败，请重试');
        }
    }



    public function login(){
        return view('user.login');
    }

    public function logindo(Request $request){
        $name = $request->post('user_name');
        $password = $request->post('password');
        if(empty($name) || empty($password)){
            return redirect('/user/login')->with('msg','用户名或密码不能为空');
        }
        $userModel = new User();
        $v = $userModel::where('user_name',$name)->first();
        if($v){
            $res = password_verify($password,$v->password);
            if($res){
                return redirect('/user/center')->with('msg','登录成功');
//                Cookie::queue($uid,['user_name'=>$name,'password'=>$password]);
            }else{
                return redirect('/user/login')->with('msg','密码错误');
            }
        }else{
            return redirect('/user/login')->with('msg','此用户不存在请在注册之后登录');
        }

    }

    public function center(){
        return view('user.center');
    }
}
