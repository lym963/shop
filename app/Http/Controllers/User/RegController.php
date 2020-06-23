<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\UserModel;
use Illuminate\Http\Request;

class RegController extends Controller
{
    public function reg()
    {
        if(request()->isMethod("get")){
            return view("user.reg");
        }
        if(request()->isMethod("post")){
            //表单验证
            request()->validate([
                'user_name' => 'bail|required|unique:p_users',
                'user_email' => 'bail|required|unique:p_users',
                'password' => 'bail|required|regex:/^\w{6,}$/',
                'password_confirmation' => 'bail|same:password',
            ],[
                "user_name.required"=>"用户名不可为空",
                "user_name.unique"=>"用户名已存在",
                "user_email.required"=>"邮箱不可为空",
                "user_email.unique"=>"邮箱已存在",
                "password.required"=>"密码不可为空",
                "password.regex"=>"密码格式不正确(必须6位以上)",
                "password_confirmation.same"=>"确认密码必须和密码一致",
            ]);
            $data=request()->except("_token","password_confirmation");
            $data["password"]=password_hash($data["password"],PASSWORD_DEFAULT);
            $data["reg_time"]=time();
            $resutl=UserModel::create($data);
            if($resutl){
                return redirect("/user/login");
            }
        }
    }
}
