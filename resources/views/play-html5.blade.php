@extends("nav")
@section("title","动画电影网")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/play.css">
@stop
@section("main")
    <div class="content">
        <div class="playSec">
            <div class="play-left">
                <svg class="vpost" viewBox="0,0,100,100" style="background: url(/play/video/screenshot?id={!! $video->screenshot !!});">
                    <g class="vpost-btn">
                        <circle r="7" cx="50" cy="50" stroke="white" fill="transparent"></circle>
                        <polygon points="48,53 48,47 53,50" fill="white"/>
                    </g>
                </svg>
                <video class="vplay" id="video">
                    <source src="/play/video?file={!! $video->url !!}&token={!! $video_token !!}" type="video/mp4" />
                </video>
                <div class="vctrl">
                    <div class="progressBar">
                        <div class="bufferBar"></div>
                        <div class="timeBar"></div>
                    </div>
                    <div class="btnPlay control-item"><i class="icon-play"></i></div>
                    <div class="progressTime control-item">
                        <span class="current">00:00</span>&nbsp;/&nbsp;
                        <span class="duration">00:00</span>
                    </div>
                    <!--controll right-->
                    <div class="fullscreen control-item right">
                        <i class="icon-fullscreen"></i>
                    </div>
                    <div class="playSpeed control-item right">
                        <div class="slow playSpeed-item">&times;0.5</div>
                        <div class="normal playSpeed-item active">&times;1</div>
                        <div class="fast playSpeed-item">&times;2</div>
                    </div>
                    <div class="control-item right">
                        <div class="muted"><i class="icon-volume-up"></i></div>
                        <div class="volumeBar">
                            <div class="volume"></div>
                        </div>
                    </div>
                    <div class="hideCtrl control-item right">
                        <i class="icon-double-angle-down"></i>
                    </div>
                </div>
            </div>
            <div class="play-right">
                <div class="play-list">
                    <div class="plist-header">
                        相关内容
                    </div>
                    @foreach($play_list as $key=>$value)
                        <div class="plist-item" data-video="{!! $value->id !!}">
                            <img src="/play/video/screenshot?id={!! $value->screenshot !!}">
                            <span class="pitem-label">{!! $value->duration !!}</span>
                            <div class="pitem-info">{!! $value->name !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="infoSec">
            <img class="info-img" src="/play/video/poster?id={!! $video->poster !!}">
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
            <div class="push-row">
                @foreach($push_list as $key=>$value)
                    <div class="push-cell" data-video="{!! $value->id !!}">
                        <div class="push-cell-img" style="background: url(/play/video/poster?id={!! $value->poster !!});"></div>
                        <div class="push-cell-info">{!! $value->name !!}</div>
                    </div>
                @endforeach
            </div>
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
                        <img src="/member/headimg?id={!! $value->headimg !!}" class="headImg">
                        <div class="item-content">
                            <div class="ic-header">{!! $value->name !!}<span class="small">{!! $value->time !!}</span></div>
                            <div class="ic-main">{!! $value->text !!}</div>
                        </div>
                    </div>
                @endforeach
                <div class="cl-pageControll">
                    <span class="pg-btn">当前位置：第5页</span>
                    <a class="pg-btn" href="javascript:void(0)">上一页</a>
                    <a class="pg-btn" href="javascript:void(0)">下一页</a>
                    <a class="pg-btn" href="javascript:void(0)">首页</a>
                    <a class="pg-btn" href="javascript:void(0)">尾页</a>
                </div>
            </div>
        </div>
    </div>

@stop
@section("js_lib")
    @parent
    <script type="text/javascript" src="/lib/jQuery-qqFace/js/jquery.qqFace.js"></script>
    <script type="text/javascript" src="/lib/jQuery-qqFace/js/jquery-browser.js"></script>
    <script type="text/javascript" src="/js/play.js"></script>
@stop