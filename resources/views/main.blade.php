@extends("nav")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/main.css">
@append
@section("content")
    <div class="leftBar"></div>
    <div class="content">
        @yield("base")
    </div>
@append
