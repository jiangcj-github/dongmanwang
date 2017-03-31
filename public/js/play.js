//
$(".playSec").on("dragstart",function(){return false;});
$(".playSec").on("selectstart",function(){return false;});
//$(".playSec").on("contextmenu",function(){return false});
var video=document.getElementById("video");
//
$(".vctrl").mouseenter(function(){
    $(".vctrl").stop().animate({"opacity":1},300);
});
$(".hideCtrl").click(function(){
    if(!video.paused){
        $(".vctrl").stop().animate({"opacity":0},300);
    }
});
//Play/Pause control clicked
$(".vpost-btn").click(function(e){
    $(".vpost").hide();
    video.play();
});
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
$(video).on("loadedmetadata", function() {
    $(".duration").text(formatSeconds(video.duration));
    $(".current").text("00:00");
});

//update HTML5 video current play time
$(video).on("timeupdate", function() {
    $(".current").text(formatSeconds(video.currentTime));
    var percentage = 100 * video.currentTime / video.duration;
    $(".timeBar").css("width", percentage+"%");
});

var timeDrag = false;   /* Drag status */
$(".progressBar").mousedown(function(e) {
    timeDrag = true;
    updatebar(e.pageX);
});
$(document).mousemove(function(e) {
    if(timeDrag) {
        $("body").css("cursor","pointer");
        updatebar(e.pageX);
    }
});
$(document).mouseup(function(e) {
    if(timeDrag) {
        timeDrag = false;
        $("body").css("cursor","initial");
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
    var currentBuffer = video.buffered.end(video.buffered.length-1);
    var percentage = 100 * currentBuffer / video.duration;
    $(".bufferBar").css("width", percentage+"%");
    if(currentBuffer < video.duration) {
        setTimeout(startBuffer, 500);
    }
};
setTimeout(startBuffer, 500);

var volumnDrag = false;   /* Drag status */
$(".volumeBar").mousedown(function(e) {
    volumnDrag = true;
    updateVolumebar(e.pageX);
});
$(document).mousemove(function(e) {
    if(volumnDrag) {
        $("body").css("cursor","pointer");
        updateVolumebar(e.pageX);
    }
});
$(document).mouseup(function(e) {
    if(volumnDrag) {
        volumnDrag = false;
        $("body").css("cursor","initial");
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

//fullscreen
$(".fullscreen").on("click", function(){
    var isFull = document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement;
    if(isFull){
        exitFullscreen();
    }else{
        enterFullScreen($(".play-left")[0])
    }
});

function enterFullScreen(obj)
{
    if(obj.requestFullscreen) {
        obj.requestFullscreen();
    }else if(obj.mozRequestFullScreen) {
        obj.mozRequestFullScreen();
    }else if(obj.webkitRequestFullscreen) {
        obj.webkitRequestFullscreen();
    }else if(obj.msRequestFullscreen) {
        obj.msRequestFullscreen();
    }
    return false;
}

function exitFullscreen()
{
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
        if(hour<10){
            hour="0"+hour;
        }
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

$(".push-cell-img").click(function(){
    var id=$(this).parent(".push-cell").data("video");
    open("/play?id="+id,"_blank");
});
$(".plist-item").click(function(){
    var id=$(this).data("video");
    open("/play?id="+id,"_blank");
});

//
$("#sc_submit").click(function(){
    var text=$("#sc_text").val();
    console.log(text);
});
