<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    public function login()
    {
        if(request()->isMethod("get")){
            return view("user.login");
        }
        if(request()->isMethod("post")){
            $data=request()->except("_token");
            $res=UserModel::where("user_name",$data["user_name"])->first();
            if($res){
                $pwd=password_verify($data["password"],$res->password);
                if($pwd==true){
                    $arr=[
                        "last_login"=>time(),
                        "last_ip"=>request()->getClientIp()
                    ];
                    UserModel::where("user_id",$res->user_id)->update($arr);
                    setcookie("user",$res->user_name);
                    return redirect("user/center");
                }
            }
            return redirect("user/login")->with("msg","用户或密码错误");
        }
    }
}
