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
            {!! $categery->name !!}
            @if($cat_page>=ceil($cat_count/20))
                <a class="disabled"><i class="glyphicon glyphicon-arrow-right"></i></a>
            @else
                <a href="/main/categery?id={!! $categery->id !!}&cat_page={!! $cat_page+1 !!}"><i class="glyphicon glyphicon-arrow-right"></i></a>
            @endif
            @if($cat_page<=1)
                <a class="disabled"><i class="glyphicon glyphicon-arrow-left"></i></a>
            @else
                <a href="/main/categery?id={!! $categery->id !!}&cat_page={!! $cat_page+1 !!}"><i class="glyphicon glyphicon-arrow-left"></i></a>
            @endif
        </div>
        @if(count($videos)<=0)
            <div class="sblank">暂无结果</div>
        @endif
        @foreach($videos as $key=>$value)
            @if($loop->index%3==0)
                <div class="srow">
            @endif
            <div class="scell" data-video="{!! $value->id !!}">
                <div class="scell-img" style="background: url(/data/video/poster/{!! $value->id !!}.png);"></div>
                <div class="scell-info">{!! $value->name !!}</div>
            </div>
            @if($loop->index%3==2||$loop->last)
                </div>
            @endif
        @endforeach
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