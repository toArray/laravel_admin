<?php

/**
 * 作用：后台登陆admin前往登录页面
 * 作者: 信
 * 时间：2018/03/20
 */
Route::get('/', function () {
    return view('login.index');
});
Route::get('admin', function () {
    return view('login.index');
});

/**
 * 作用：后台登陆路由集合
 * 作者: 信
 * 时间：2018/03/20
 */
Route::group(["prefix"=>"login","namespace"=>"Login"],function (){
    /*跳到登陆页面*/
    Route::get("index","IndexController@index");
    /*执行登陆验证操作*/
    Route::post("login","IndexController@login");
});


/**
 * 作用：后台基本操作路由(有admin中间件)
 * 作者: 信
 * 时间：2018/03/20
 */
Route::group(["prefix"=>"index","middleware"=>["admin"],"namespace"=>"Index"],function (){
    /*跳到后台主页*/
    Route::get("index","IndexController@index");
    /*注销操作*/
    Route::get("logout","IndexController@logout")->name("index.logout");
});


/**
 * 作用：后台机器人管理
 * 作者: 信
 * 时间：2018/03/20
 */
Route::group(["prefix"=>"robot","middleware"=>["admin"],"namespace"=>"robot"],function (){
    /*显示所有机器人*/
    Route::get("index","RobotController@index");

});



