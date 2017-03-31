@extends("mobile/main")
@section("css")
    @parent
    <style>
        .section{background: white;border:1px solid #cfcfcf;margin-bottom:10px;}
        .section-header{font-size:1.2em;line-height:2.4;padding:0 15px;border-bottom:1px solid #cfcfcf;font-weight:bold;}
        .section-header>a{float:right;margin-left:10px;}
        .section-header>a.disabled{color: #cfcfcf;cursor: default;}
        .sblank{padding:10px;}
        .srow{display:flex;margin:10px 0;padding:0 5px;}
        .scell{width:35%;padding:0 5px;}
        .scell-img{width:100%;height:0px;padding-bottom:133%;background-size:100% 100% !important;border:1px solid #cfcfcf;}
        .scell-img:hover{opacity:0.8;cursor:pointer;}
        .scell-info{text-align:center;word-wrap:break-word;height:20px;line-height:20px;overflow:hidden;}
    </style>
@stop
@section("content")
    <div class="section">
        <div class="section-header">
            最新上映
            <a href="#"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
        <div class="srow">
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">火影忍者剧场版8-忍者之路</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
        </div>
        <div class="srow">
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
        </div>
        <div class="srow">
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
        </div>
    </div>
    <div class="section">
        <div class="section-header">
            最新上映
            <a href="#"><i class="glyphicon glyphicon-plus"></i></a>
        </div>
        <div class="srow">
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">火影忍者剧场版8-忍者之路</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
        </div>
        <div class="srow">
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
        </div>
        <div class="srow">
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
            <div class="scell">
                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                <div class="scell-info">萤火之森</div>
            </div>
        </div>
    </div>
@stop
