<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextController extends Controller
{
    public function text(){
        echo date('Y-m-d,H:i:s');
    }
}
