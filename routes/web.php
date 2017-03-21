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

Route::get("/headimg","MemberController@getHeadimg");

Route::get("/play","PlayController@getPlay");
Route::get("/video","PlayController@getVideo");

Route::get("/main","MainController@getMain");
