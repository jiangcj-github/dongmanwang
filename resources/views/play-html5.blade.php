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
                <video class="vplay" autoplay id="video">
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
    <script type="text/javascript" src="/js/compile.js"></script>
@stop
@section("js")
    @parent
    <script>
        $(".playSec").on("dragstart",function(){return false;});
        $(".playSec").on("selectstart",function(){return false;});
        $(".vctr").mouseenter(function(){
            $(this).css("opacity","1");
        });
        $(".vctr").mouseleave(function(){
            if(!video.paused){
                $(this).css("opacity","0");
            }
        });

        var video=document.getElementById("video");
        $(".vpost-btn").click(function(e){
            $(".vpost").hide();
            video.play();
        });
        //Play/Pause control clicked
        $(".btnPlay").on("click", function() {
            if(video.paused) {
                video.play();
            }else {
                video.pause();
            }
        });
        $(video).on("play",function(e){
            $(".btnPlay").children("i").removeClass("icon-play");
            $(".btnPlay").children("i").addClass("icon-pause");
        });
        $(video).on("pause",function(e){
            $(".btnPlay").children("i").removeClass("icon-pause");
            $(".btnPlay").children("i").addClass("icon-play");
        });
        $(video).on("error",function(e){
            $("#verr").addClass("eject");
            $("#verr").html("当前视频无法播放，请<a href='javascript:location.reload()'>刷新</a>页面！");
        });
        $(video).on("loadedmetadata", function() {
            $(".duration").text(formatSeconds(video.duration));
            $(".current").text("00:00");
        });

        //update HTML5 video current play time
        $(video).on("timeupdate", function() {
            $(".current").text(formatSeconds(video.currentTime));
            var currentPos = video.currentTime;
            var maxduration = video.duration;
            var percentage = 100 * currentPos / maxduration;
            $(".timeBar").css("width", percentage+"%");
        });

        var timeDrag = false;   /* Drag status */
        $(".progressBar").mousedown(function(e) {
            timeDrag = true;
            updatebar(e.pageX);
        });
        $(document).mouseup(function(e) {
            if(timeDrag) {
                timeDrag = false;
                updatebar(e.pageX);
            }
        });
        $(document).mousemove(function(e) {
            if(timeDrag) {
                updatebar(e.pageX);
            }
        });

        //update Progress Bar control
        var updatebar = function(x) {
            var progress = $(".progressBar");
            var maxduration = video.duration; //Video duraiton
            var position = x - progress.offset().left; //Click pos
            var percentage = 100 * position / progress.width();
            if(percentage > 100) {
                percentage = 100;
            }
            if(percentage < 0) {
                percentage = 0;
            }
            $(".timeBar").css("width", percentage+"%");
            video.currentTime = maxduration * percentage / 100;
        };

        var startBuffer = function() {
            if(video.buffered.length<=0){
                $(video).trigger("error");
                return;
            }
            var maxduration = video.duration;
            var currentBuffer = video.buffered.end(video.buffered.length-1);
            var percentage = 100 * currentBuffer / maxduration;
            $(".bufferBar").css("width", percentage+"%");
            if(currentBuffer < maxduration) {
                setTimeout(startBuffer, 500);
            }
        };
        setTimeout(startBuffer, 500);

        var volumnDrag = false;   /* Drag status */
        $(".volumeBar").mousedown(function(e) {
            volumnDrag = true;
            updateVolumebar(e.pageX);
        });
        $(document).mouseup(function(e) {
            if(volumnDrag) {
                volumnDrag = false;
                updateVolumebar(e.pageX);
            }
        });
        $(document).mousemove(function(e) {
            if(volumnDrag) {
                updateVolumebar(e.pageX);
            }
        });

        //update Progress Bar control
        var updateVolumebar = function(x) {
            var volumeBar = $(".volumeBar");
            var position = x - volumeBar.offset().left;
            var percentage = 100 * position / volumeBar.width();
            if(percentage > 100) {
                percentage = 100;
            }
            if(percentage < 0) {
                percentage = 0;
            }
            $(".volume").css("width", percentage+"%");
            video.volume = percentage / 100;
        };

        $(".fast").on("click", function() {
            video.playbackRate = 2.0;
            $(".playSpeed .active").removeClass("active");
            $(".fast").addClass("active");
            return false;
        });

        //Rewind control
        $(".normal").on("click", function() {
            video.playbackRate =1.0;
            $(".playSpeed .active").removeClass("active");
            $(".normal").addClass("active");
            return false;
        });

        //Rewind control
        $(".slow").on("click", function() {
            video.playbackRate = 0.5;
            $(".playSpeed .active").removeClass("active");
            $(".slow").addClass("active");
            return false;
        });

        $(".fullscreen").on("click", function() {
            var videoDiv=document.getElementById("videoDiv");
            enterFullScreen(videoDiv)
        });

        function enterFullScreen(obj){
            if(obj.requestFullscreen) {
                obj.requestFullscreen();
            } else if(obj.mozRequestFullScreen) {
                obj.mozRequestFullScreen();
            } else if(obj.webkitRequestFullscreen) {
                obj.webkitRequestFullscreen();
            } else if(obj.msRequestFullscreen) {
                obj.msRequestFullscreen();
            }
            return false;
        }

        function exitFullscreen() {
            if(document.exitFullscreen) {
                document.exitFullscreen();
            } else if(document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if(document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }

        function formatSeconds(s){
            s=parseInt(s);
            var hour="",minute="",second="";
            if(s>3600){
                hour=parseInt(s/3600);
                s=s%3600;
                hour=hour+":"
            }
            minute=parseInt(s/60);
            s=s%60;
            if(minute<10){
                minute="0"+minute;
            }
            second=s;
            if(second<10){
                second="0"+second;
            }
            return hour+minute+":"+second;
        }

        //
        $('.sc_emotion img').qqFace({
            assign:'sc_text',
            path:'/lib/jQuery-qqFace/arclist/',
            id:'face_2'
        });
        //

        //
        function replace_em(str){
            str = str.replace(/\</g,'&lt;');
            str = str.replace(/\>/g,'&gt;');
            str = str.replace(/\n/g,'<br/>');
            str = str.replace(/\[em_([0-9]*)\]/g,'<img src="/lib/jQuery-qqFace/arclist/$1.gif" border="0" />');
            return str;
        }

        $(".r_list_time").text(function(){
            return formatSeconds($(this).text());
        });
        $(".r_list_content").html(function(){
            return replace_em($(this).html());
        });
        $(".ic-main").html(function(){
            return replace_em($(this).html());
        });
        $(".reply-content").html(function(){
            return replace_em($(this).html());
        });
    </script>
@stop
