@extends("mobile/nav")
@section("title","动画电影网")
@section("css")
    @parent
    <style>
        .main{display:flex;justify-content:center}
        .page{width:100%;padding:10px;}
    </style>
@stop
@section("main")
    <div class="main">
        <div class="page">
            @yield("content")
        </div>
    </div>
@stop
