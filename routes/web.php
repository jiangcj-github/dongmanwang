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

Route::get("/","AdminController@test");

Route::get("/m1",function(){
   return response()->view("content/m1");
});

Route::get("/main2",function(){
   return response()->view("main2");
});

Route::get("/play","PlayController@getPlay");
Route::get("/play/video","PlayController@getMp4");

Route::get("/main","MainController@getMain");

Route::get("/admin","AdminController@admin");
Route::post("/admin/login","AdminController@login");
Route::group(["middleware"=>"admin"],function(){
    Route::get("/admin/home","AdminController@getHome");
    Route::post("/admin/home/addCategery","AdminController@addCategery");
    Route::post("/admin/home/deleteCategery","AdminController@deleteCategery");
    Route::post("/admin/home/deleteCategerys","AdminController@deleteCategerys");
    Route::post("/admin/home/renameCategery","AdminController@renameCategery");
    Route::post("/admin/home/uploadPoster","AdminController@uploadPoster");
    Route::post("/admin/home/uploadVideo","AdminController@uploadVideo");
    Route::post("/admin/home/addVideo","AdminController@addVideo");

    Route::get("/admin/video","AdminController@getVideoManage");
    Route::post("/admin/video/deleteV","AdminController@deleteV");
    Route::post("/admin/video/deleteVs","AdminController@deleteVs");
    Route::get("/admin/video/update","AdminController@getVideoUpdate");
    Route::post("/admin/video/update/uploadPoster","AdminController@uploadPoster2");
    Route::post("/admin/video/update/uploadVideo","AdminController@uploadVideo2");
    Route::post("/admin/video/update/updateVideo","AdminController@updateVideo");
    Route::get("/admin/video/update/updateVideo","AdminController@updateVideo");
    Route::get("/admin/video/update/updateVideoFrame","AdminController@updateVideoFrame");
});




