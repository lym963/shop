<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use App\Model\GoodsModel;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    public function detail()
    {
        $goods_id=request()->get("id");
        $info=GoodsModel::find($goods_id);
        dd($info);
    }
}
