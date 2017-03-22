<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get("/",function(){
   return response()->view("main");
});

Route::get("/m1",function(){
   return response()->view("content/m1");
});

Route::get("/main2",function(){
   return response()->view("main2");
});

Route::get("/member/headimg","MemberController@getHeadimg");

Route::get("/play","PlayController@getPlay");
Route::get("/play/video","PlayController@getVideo");
Route::get("/play/video/poster","PlayController@getPoster");
Route::get("/play/video/screenshot","PlayController@getScreenShot");

Route::get("/main","MainController@getMain");

Route::get("/admin","AdminController@admin");
Route::post("/admin/login","AdminController@login");
Route::group(["middleware"=>"admin"],function(){
    Route::get("/admin/home","AdminController@getHome");
    Route::post("/admin/home/addCategery","AdminController@addCategery");
    Route::post("/admin/home/deleteCategery","AdminController@deleteCategery");
    Route::post("/admin/home/renameCategery","AdminController@renameCategery");
});


