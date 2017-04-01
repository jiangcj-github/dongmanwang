@extends("desktop/nav")
@section("title","动画电影网")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/play.css">
    <link rel="stylesheet" href="/css/plugin.css">
@stop
@section("main")
    <div class="content">
        <div class="playSec">
            <div class="play-left">
                <svg class="vpost" viewBox="0,0,100,100" style="background: url(/data/video/frame/{!! $video->id !!}.jpg);">
                    <g class="vpost-btn">
                        <circle r="7" cx="50" cy="50" stroke="white" fill="transparent"></circle>
                        <polygon points="48,53 48,47 53,50" fill="white"/>
                    </g>
                </svg>
                <video class="vplay" id="video">
                    <source src="/play/video?id={!! $video->id !!}&token={!! $video_token !!}" type="video/mp4" />
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
                            <img src="/data/video/frame/{!! $value->id !!}.jpg">
                            <span class="pitem-label">{!! $value->duration !!}</span>
                            <div class="pitem-info">{!! $value->name !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
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
            <div class="push-row">
                @foreach($push_list as $key=>$value)
                    <div class="push-cell" data-video="{!! $value->id !!}">
                        <div class="push-cell-img" style="background: url(/data/video/poster/{!! $value->id !!}.png);"></div>
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
                <div class="sc_img_header">
                    <button class="btn btn-warning btn-xs sc_btn_img" onclick="$(this).next().click();">添加图片</button>
                    <input type="file" style="display: none" id="sc_input_img">
                    <span style="font-size:0.8em;color:#acb4bb;">仅限png格式,默认比例(8:5),最多5张</span>
                    <span id="sc_img_error"></span>
                </div>
                <div class="sc_img"></div>
                <textarea class="sc_text" rows="5" id="sc_text"></textarea>
                <div class="sc_emotion">
                    <img src="/img/sc_face.png" id="sc_face" style="width:24px;height:24px;">
                    <img src="/img/sc_link.png" id="sc_link" style="width:24px;height:24px;">
                    <div id="sc_link_popup">
                        <input type="text" placeholder="链接文本">
                        <input type="url" placeholder="链接地址">
                        <button class="btn btn-warning">确认</button>
                    </div>
                </div>
                <div class="sc_submit" id="sc_submit" data-video="{!! $video->id !!}">提交</div>
            </div>
            <div class="com-list" id="commentList">
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
                            @if($value->img!=null)
                                <div class="ic-img">
                                @foreach(explode("-",$value->img,-1) as $im)
                                    <img src="/data/comment/img/{!! $value->id !!}/{!! $im !!}.png">
                                @endforeach
                                </div>
                            @endif
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
                        <button class="btn btn-warning btn-xs" onclick="location.href='/play?id={!! $video->id !!}&cm_page={!! $cm_page-1 !!}#commentList'">上一页</button>
                    @endif
                    @if($cm_page>=ceil($cm_count/10))
                        <button class="btn btn-warning btn-xs" disabled>下一页</button>
                    @else
                        <button class="btn btn-warning btn-xs" onclick="location.href='/play?id={!! $video->id !!}&cm_page={!! $cm_page+1 !!}#commentList'">下一页</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div style="height:100px;"></div>
    <input type="hidden" value="{!! csrf_token() !!}" id="_token">
@stop
@section("js_lib")
    @parent
    <script type="text/javascript" src="/lib/jQuery-qqFace/js/jquery.qqFace.js"></script>
    <script type="text/javascript" src="/lib/jQuery-qqFace/js/jquery-browser.js"></script>
    <script type="text/javascript" src="/js/plugin.js"></script>
    <script type="text/javascript" src="/js/play.js"></script>
@stop