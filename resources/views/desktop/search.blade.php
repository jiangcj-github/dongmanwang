@extends("nav")
@section("title","动画电影网")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/main2.css">
@stop
@section("css")
    @parent
    <style>
        .main{display:flex;justify-content:center}
        .page{width:80%;padding-top:20px;}

        .section{background: white;border:1px solid #cfcfcf;;margin-bottom:20px;}
        .section-header{font-size:1.2em;line-height:2.4;padding:0 15px;border-bottom:1px solid #cfcfcf;font-weight:bold;}
        .srow{display:flex;margin:20px 0;padding:0 20px;}
        .scell{width:20%;padding:0 10px;}
        .scell-img{width:100%;height:0px;padding-bottom:133%;background-size:100% 100% !important;border:1px solid #cfcfcf;}
        .scell-img:hover{opacity:0.8;cursor:pointer;}
        .scell-info{text-align:center;word-wrap:break-word;height:20px;line-height:20px;overflow:hidden;}
        .sblank{padding:10px;}
    </style>
@stop
@section("main")
    <div class="main">
        <div class="page">
            <div class="content">
                @foreach($searchs as $key=>$list)
                    <div class="section">
                        <div class="section-header">
                            {!! $key !!}
                        </div>
                        @if(count($list)<=0)
                            <div class="sblank">无匹配结果</div>
                        @endif
                        @foreach($list as $key=>$value)
                            @if($loop->index%5==0)
                                <div class="srow">
                            @endif
                            <div class="scell" data-video="{!! $value->id !!}">
                                <div class="scell-img" style="background: url(/data/video/poster/{!! $value->id !!}.png);"></div>
                                <div class="scell-info">{!! $value->name !!}</div>
                            </div>
                            @if($loop->index%5==4||$loop->last)
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
@section("js")
    @parent
    <script>
        $(".scell-img").click(function(){
            var id=$(this).parent(".scell").data("video");
            open("/play?id="+id,"_blank");
        });
    </script>
@stop