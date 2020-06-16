<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
class GoodsController extends Controller
{
    /*
     * 商品详情
     * */
    public function detail(){
        $goods_id = $_GET['id'];
        $info = Goods::find($goods_id);
//        echo 'goods_id:'.$goods_id;echo '</<br>';
        echo '<pre>';print_r($info);echo '</pre>';
    }
}
