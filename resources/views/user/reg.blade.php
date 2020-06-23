<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>前台注册页面</title>
</head>
<body>
<center>
    @if(!empty(session('msg')))
        <div>
            {{session('msg')}}
        </div>
    @endif
    <form method="post" action="/user/regdo">
        @csrf
        用户名: <input type="text" name="user_name"><span></span><br>
        Email: <input type="email" name="email"><span></span><br>
        密码: <input type="password" name="password"><span></span><br>
        确认密码: <input type="password" name="passwordker"><span></span><br>
        <input type="submit" id="reg" value="注册">
    </form>
</center>
</body>
<html>

