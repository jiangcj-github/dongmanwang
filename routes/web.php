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
Route::get("/","PlayController@getVideo");
Route::get("/main","MainController@getMain");
Route::get("/play","PlayController@getPlay");
Route::get("/video","PlayController@getVideo");