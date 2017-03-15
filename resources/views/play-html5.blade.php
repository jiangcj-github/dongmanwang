@extends("nav")
@section("title","play")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/play.css">
@stop
@section("content")
    <div class="content">
        <div class="playSec">
            <div class="play-left">
                <svg class="vpost" viewBox="0,0,100,100" style="background: url(img/Koala.jpg);">
                    <g class="vpost-btn">
                        <circle r="7" cx="50" cy="50" stroke="white" fill="transparent"></circle>
                        <polygon points="48,53 48,47 53,50" fill="white"/>
                    </g>
                </svg>
                <div class="verr">加载视频出错</div>
                <video class="vplay" id="video">
                    <source src="mv/1.mp4" type="video/mp4" />
                </video>
                <div class="vctrl">
                    <div class="progressBar">
                        <div class="bufferBar"></div>
                        <div class="timeBar"></div>
                    </div>
                    <div class="btnPlay control-item"><i class="icon-play"></i></div>
                    <div class="progressTime control-item">
                        <span class="current">00:00</span>/
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

                </div>
            </div>
            <div class="play-right">
                <div class="play-list">
                    <div class="plist-header">
                        相关内容
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="commentDiv">
            <div class="sendComment">
                <div class="sc_label">
                    发表留言:
                </div>
                <textarea class="sc_text" rows="5" id="sc_text"></textarea>
                <div class="sc_emotion"><img src="/img/laugh.png" style="width:24px;height:24px;"></div>
                <div class="sc_submit">提交</div>
            </div>
            <div class="commentList">
                <div class="cl_header">
                    <a href="javascript:void(0);">按时间</a>
                    <span style="margin-left:3px;margin-right: 3px;color:black;">|</span>
                    <a href="javascript:void(0);">按热度</a>
                </div>
                @foreach([1,2,3,4,5] as $k)
                    <div class="cl-item">
                        <img src="" class="headImg">
                        <div class="item-content">
                            <div class="ic-header">name<span class="small">time</span></div>
                            <div class="ic-main">text</div>
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