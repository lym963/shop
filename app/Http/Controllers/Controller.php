<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /*
     *返回数据
     */
    public function response($error,$msg,$access_token="",$data=[]){
        $arr=[
            "error"=>$error,
            "msg"=>$msg,
        ];
        if($access_token){
            $arr["access_token"]=$access_token;
        }
        if($data){
            $arr["data"]=$data;
        }
        return $arr;
    }
}
