@extends("mobile/nav")
@section("title","动画电影网")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/play-mobile.css">
@stop
@section("main")
    <div class="content">
        <div class="playSec">
            <svg class="vpost" viewBox="0,0,100,100" style="background: url(/data/video/frame/{!! $video->id !!}.jpg);">
                <g class="vpost-btn">
                    <circle r="10" cx="50" cy="50" stroke="white" fill="transparent"></circle>
                    <polygon points="47,56 47,44 56,50" fill="white"/>
                </g>
            </svg>
            <video class="vplay" id="video" controls>
                <source src="/play/video?id={!! $video->id !!}&token={!! $video_token !!}" type="video/mp4" />
            </video>
        </div>
        <div class="infoSec">
            <img class="info-img" src="/data/video/poster/{!! $video->id !!}.png">
            <div class="info-text">
                <div class="info-text-name">{!! $video->name !!}</div>
                <div class="info-text-line">地区：{!! $video->nation !!}</div>
                <div class="info-text-line">作者：{!! $video->author !!}</div>
                <div class="info-text-line">上映时间：{!! $video->firstshow !!}</div>
                <div class="info-text-line">时长：{!! $video->duration !!}</div>
            </div>
        </div>
        <div class="pushSec">
            <div class="push-header">
                相关内容
            </div>
            @foreach($push_list as $key=>$value)
                @if($loop->index%3==0)
                    <div class="push-row">
                @endif
                    <div class="push-cell" data-video="{!! $value->id !!}">
                        <div class="push-cell-img" style="background: url(/data/video/poster/{!! $value->id !!}.png);"></div>
                        <div class="push-cell-info">{!! $value->name !!}</div>
                    </div>
                @if($loop->index%3==2)
                    </div>
                @endif
            @endforeach
        </div>
        <div class="commentSec">
            <div class="com-send">
                <div class="sc_label">
                    发表留言:
                </div>
                <textarea class="sc_text" rows="5" id="sc_text"></textarea>
                <div class="sc_emotion"><img src="/img/laugh.png" style="width:24px;height:24px;"></div>
                <div class="sc_submit">提交</div>
            </div>
            <div class="com-list">
                <div class="cl_header">
                    <a href="javascript:void(0);">按时间</a>
                    <span style="margin-left:3px;margin-right: 3px;color:black;">|</span>
                    <a href="javascript:void(0);">按热度</a>
                </div>
                @foreach($comment as $key=>$value)
                    <div class="cl-item">
                        <img src="/data/member/headimg/{!! $value->user_id !!}.png" class="headImg">
                        <div class="item-content">
                            <div class="ic-header">{!! $value->name !!}<span class="small">{!! \App\Util\TimeUtil::time_tran($value->time) !!}</span></div>
                            <div class="ic-main">{!! $value->text !!}</div>
                        </div>
                    </div>
                @endforeach
                <div class="cl-pageControll">
                    <span class="pg-btn">第{!! $cm_page !!}页</span>
                    <span class="pg-btn">共{!! ceil($cm_count/10) !!}页</span>
                    @if($cm_page<=1)
                        <button class="btn btn-warning btn-xs" disabled>上一页</button>
                    @else
                        <button class="btn btn-warning btn-xs" onclick="location.href='/play?id={!! $video->id !!}&cm_page={!! $cm_page-1 !!}'">上一页</button>
                    @endif
                    @if($cm_page>=ceil($cm_count/10))
                        <button class="btn btn-warning btn-xs" disabled>下一页</button>
                    @else
                        <button class="btn btn-warning btn-xs" onclick="location.href='/play?id={!! $video->id !!}&cm_page={!! $cm_page+1 !!}'">下一页</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
@section("js_lib")
    @parent
    <script type="text/javascript" src="/lib/jQuery-qqFace/js/jquery.qqFace.mobile.js"></script>
    <script type="text/javascript" src="/lib/jQuery-qqFace/js/jquery-browser.js"></script>
    <script type="text/javascript" src="/js/play.js"></script>
@stop
@section("js")
    @parent
    <script>
        $(".qqFace td img").click(function(e){
           console.log("hh");
        });
    </script>
@stop