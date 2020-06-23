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
Route::get("/test","TestController@index");



//商品
Route::get("/goods/detail","Goods\GoodsController@detail");  //商品详情
//注册
Route::any("/user/reg","User\RegController@reg");
//登陆
Route::any("/user/login","User\LoginController@login");
//个人中心
Route::any("/user/center","User\CenterController@center");

