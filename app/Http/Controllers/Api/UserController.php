<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\TokenModel;
use App\Model\UserModel;
use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
     * 注册接口
     * */
    public function reg()
    {
        //判断请求方法
        if(!request()->isMethod("post")){
            return $this->response(50000,"请求方法不正确");
        }
        //接参
        $name=request()->post("name");
        $email=request()->post("email");
        $password=request()->post("password");
        $pwd=request()->post("pwd");
        //判断不为空
        if(empty($name) || empty($email) || empty($password) || empty($pwd)){
            return $this->response(50001,"参数缺失");
        }
        //验证用户名是否存在
        $res=UserModel::where("user_name",$name)->first();
        if($res){
            return $this->response(50002,"用户已存在");
        }
        //验证邮箱是否存在
        $res=UserModel::where("user_email",$email)->first();
        if($res){
            return $this->response(50003,"邮箱已存在已存在");
        }
        //验证密码长度
        if(strlen($password)<6){
            return $this->response(50004,"密码必须大于6位");
        }
        //验证密码和确认密码是否一致
        if($password != $pwd){
            return $this->response(50005,"密码和确认密码不一致");
        }
        //添加入库
        $data=[
            "user_name"=>$name,
            "user_email"=>$email,
            "password"=>password_hash($password,PASSWORD_DEFAULT),
            "reg_time"=>time()
        ];
        $result=UserModel::create($data);
        if($result){
            return $this->response(0,"注册成功");
        }
        return $this->response(1,"注册失败");
    }


    /*
     *登陆接口
     */
    public function login()
    {
        //判断请求方法
        if(!request()->isMethod("post")){
            echo "123";
            return $this->response(50000,"请求方法不正确");
        }
        echo "231";
        //接参
        $name=request()->post("name");
        $password=request()->post("password");
        //判断不为空
        if(empty($name) || empty($password)){
            return $this->response(50001,"参数缺失");
        }
        //查询用户名密码是否正确
        //用户名
        $res=UserModel::where("user_name",$name)->first();
        if($res){
            //密码
            $pwd=password_verify($password,$res->password);
            if($pwd==true){
                //修改登陆时间
                $arr=[
                    "last_login"=>time(),
                    "last_ip"=>request()->getClientIp()
                ];
                UserModel::where("user_id",$res->user_id)->update($arr);
                //生成token
                $token=md5($res->user_id.rand(100000,999999).time());
                $access_token=substr($token,5,15).substr($token,10,15).substr($token,15,15);
                //讲access_token存入redis
                Redis::set($access_token,$res->user_id);
                //讲access_token存入数据库
//                TokenModel::create(["user_id"=>$res->user_id,"access_token"=>$access_token,"create_time"=>time()]);
                return $this->response(0,"登陆成功",$access_token);
            }
        }
        return $this->response(1,"登陆失败");
    }

    /*
     * 个人中心接口
     */
    public function center()
    {
        //判断请求方法
        if(!request()->isMethod("get")){
            return $this->response(50000,"请求方法不正确");
        }
        $access_token=request()->get("access_token");
        $user_id=Redis::get($access_token);
        $user=UserModel::where("user_id",$user_id)->first();
        $data=[
            "user_name"=>$user->user_name,
            "user_email"=>$user->user_email,
            "reg_time"=>$user->reg_time,
            "last_login"=>$user->last_login
        ];
        return $this->response(0,"成功","",$data);
    }



}
