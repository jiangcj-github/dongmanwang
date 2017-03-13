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

Route::get('/', function () {
    return view('/main');
});

Route::get("/main","MainController@getMain");
Route::get('/list1','MainController@getList1');
Route::get('/list2','MainController@getList2');
Route::get('/list3','MainController@getList3');
Route::get('/list4','MainController@getList4');
Route::get('/list5','MainController@getList5');

Route::get('/image','PlayController@getImage');
Route::get('/play','PlayController@getPlay');
Route::get('/video','PlayController@getVideo');
Route::get('/mv/1.mp4',function(){
    return view("redirect");
});
Route::get('/redirect',function(){
    return view("redirect");
});