@extends("nav")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/main.css">
@append
@section("css")
    @parent
    <style>
        #mainDiv{
            display: flex;
            justify-content: center;
            align-items: flex-start;
            width:100%;
            min-height: 500px;
        }
        #sideDiv{
            width:200px;
            border:1px solid #337ab7;
            border-radius: 5px;
        }
        #rightDiv{
            width:800px;
            margin-left:33px;
            background: #e0eee8;
            height:2009px;
        }
    </style>
@append
@section("content")
    <div class="container">
        <div class="section" style="height: 300px">
            <div class="section-header">
                Title 1
                <a href="#"><i class="glyphicon glyphicon-plus"></i></a>
                <a href="#"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        </div>
        <div style="height: 10px"></div>
        <div class="section" style="height:300px">
            <div class="section-header">
                Title 2
            </div>
        </div>
        <div style="height:10px"></div>
        <div class="section" style="height:300px">

        </div>
    </div>
@append
