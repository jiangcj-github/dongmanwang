@extends("nav")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/main.css">
@append
@section("content")
    <div class="container">
        <div class="section" style="height: 300px">
            <div class="section-header">
                最新上映
                <a href="#"><i class="glyphicon glyphicon-plus"></i></a>
                <a href="#"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <div class="section" style="height:300px">
            <div class="section-header">
                日本动漫
            </div>
        </div>
        <div class="section" style="height:300px">
            <div class="section-header">
                国产动漫
            </div>
        </div>
    </div>
@append
