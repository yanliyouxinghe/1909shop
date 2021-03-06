<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/info', function () {
   phpinfo();
});
Route::any('/goods/detail','Goods\GoodsController@detail');

Route::any('/text','TextController@text');
Route::any('/sing','TextController@sing');

Route::any('/text/receive','TextController@receive');
Route::any('/text/receive_post','TextController@receive_post');

Route::get('/text/encrypt1','TextController@enctype1');
//用户注册
//前台：
Route::get('/user/reg','User\UserController@reg');
Route::post('/user/regdo','User\UserController@regdo');
//后台:
Route::post('/user/reghou','User\UserController@reghou');



//用户登录
//前台：
Route::get('/user/login','User\UserController@login');
Route::post('/user/logindo','User\UserController@logindo');
Route::get('/user/center','User\UserController@center');
//后台:
Route::post('/user/loginhou','User\UserController@loginhou');



//api
Route::post('/api/user/apireg','Api\UserController@apireg');
Route::post('/api/user/login','Api\UserController@logindo');

Route::middleware('check.pri','check.pro')->group(function (){
  Route::post('/api/user/center','Api\UserController@center');
Route::post('/api/user/order','Api\UserController@order');
Route::post('/api/user/cart','Api\UserController@cart');
});

