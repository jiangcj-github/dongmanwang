@extends("nav")
@section("title","动画电影网")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/main2.css">
@append
@section("main")
    <div class="main">
        <div class="page">
            <div class="content">
                <div class="section">
                    <div class="section-header">
                        {!! $categery->name !!}
                    </div>
                    @foreach($videos as $key=>$value)
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
            </div>
        </div>
    </div>
@append
@section("js")
    <script>
        $(".scell-img").click(function(){
            var id=$(this).parent(".scell").data("video");
            open("/play?id="+id,"_blank");
        });
    </script>
@append