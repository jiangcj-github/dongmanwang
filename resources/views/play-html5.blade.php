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
                <svg class="vpost" viewBox="0,0,100,100" style="background: url(img/1.jpg);">
                    <g class="vpost-btn">
                        <circle r="7" cx="50" cy="50" stroke="white" fill="transparent"></circle>
                        <polygon points="48,53 48,47 53,50" fill="white"/>
                    </g>
                </svg>
                <video class="vplay" id="video">
                    <source src="/video" type="video/mp4" />
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
                    <div class="plist-item playing">
                        <img src="img/Koala.jpg">
                        <span class="pitem-label">48:00</span>
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <span class="pitem-label">48:00</span>
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <span class="pitem-label">48:00</span>
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <span class="pitem-label">48:00</span>
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <span class="pitem-label">48:00</span>
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                    <div class="plist-item">
                        <img src="img/Koala.jpg">
                        <span class="pitem-label">48:00</span>
                        <div class="pitem-info">
                            喜洋洋和灰太狼
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="infoSec">
            <img class="info-img" src="img/1.jpg">
            <div class="info-text">
                <div class="info-text-name">你的名字</div>
                <div class="info-text-line">地区：日本</div>
                <div class="info-text-line">作者：新海诚</div>
                <div class="info-text-line">上映时间：2016</div>
                <div class="info-text-line">时长：02:34:00</div>
            </div>
        </div>
        <div class="pushSec">
            <div class="push-header">
                相关内容
            </div>
            <div class="push-row">
                <div class="push-cell">
                    <div class="push-cell-img" style="background: url(/img/1.jpg);"></div>
                    <div class="push-cell-info">萤火之森</div>
                </div>
                <div class="push-cell">
                    <div class="push-cell-img" style="background: url(/img/1.jpg);"></div>
                    <div class="push-cell-info">萤火之森</div>
                </div>
                <div class="push-cell">
                    <div class="push-cell-img" style="background: url(/img/1.jpg);"></div>
                    <div class="push-cell-info">萤火之森</div>
                </div>
                <div class="push-cell">
                    <div class="push-cell-img" style="background: url(/img/1.jpg);"></div>
                    <div class="push-cell-info">萤火之森</div>
                </div>
                <div class="push-cell">
                    <div class="push-cell-img" style="background: url(/img/1.jpg);"></div>
                    <div class="push-cell-info">萤火之森</div>
                </div>
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
                @foreach([1,2,3,4,5] as $k)
                    <div class="cl-item">
                        <img src="" class="headImg">
                        <div class="item-content">
                            <div class="ic-header">name<span class="small">time</span></div>
                            <div class="ic-main">CSS 后代选择器 CSS 相邻兄弟选择器 与后代选择器相比,CSS 后代选择器 CSS 相邻兄弟选择器 与后代选择器相比,子元素选择器(Child selectors)只能选择作为某元素子元素的元素。选择子元素 如果您不希望选择任意的后代元素...子元素选择器(Child selectors)只能选择作为某元素子元素的元素。选择子元素 如果您不希望选择任意的后代元素...</div>
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