<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>前台首页</title>
</head>
<body>
<center>
    @if(!empty(session('msg')))
        <div>
            {{session('msg')}}
        </div>
    @endif

    <h2>欢迎{{$_COOKIE['name']}}登录</h2>
</center>
</body>
<html>
