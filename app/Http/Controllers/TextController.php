<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
class TextController extends Controller
{
    public function text(){
        $keys = 'sex';
       $val1 = Redis::get($keys);
        var_dump($val1);echo '</br>';
       echo '$val1;'.$val1;
    }
}
