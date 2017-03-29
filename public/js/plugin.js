//slider
$(".slider").click(function(e){
    var pos=e.pageX-$(this).offset().left;
    var per=100*(pos/$(this).width());
    if(per<0){
        per=0;
    }else if(per>100){
        per=100;
    }
    var _this=this;
    $(this).sliderClickCallback.forEach(function(e,i){
        (e.bind(_this))(Math.round(per));
    });
    updateSlider(e.pageX,$(this));
});
var slider=null;
$(".slider").mousedown(function(e) {
    slider=$(this);
    updateSlider(e.pageX,slider);
});
$(document).mousemove(function(e) {
    if(slider) {
        $("body").css("cursor","pointer");
        updateSlider(e.pageX,slider);
    }
});
$(document).mouseup(function(e) {
    if(slider) {
        $("body").css("cursor","initial");
        updateSlider(e.pageX,slider);
        slider=null;
    }
});
function updateSlider(x,slider){
    var pos=x-slider.offset().left;
    var per=100*(pos/slider.width());
    if(per<0){
        per=0;
    }else if(per>100){
        per=100;
    }
    var oldValue=parseInt($(slider).children(".slider-value").text().slice(0,-1));
    var newValue=Math.round(per);
    var _this=this;
    slider.sliderChangeCallback.forEach(function(e,i){
        if(newValue!=oldValue){
            (e.bind(_this))(newValue);
        }
    });
    slider.children(".slider-btn").css("left",per+"%");
    slider.children(".slider-value").text(newValue+"%");
}
$(".slider").on("selectstart",function(){return false;});

$.fn.extend({
    sliderValue:function(){
        if($(this).hasClass("slider")){
            return parseInt($(this).children(".slider-value").text().slice(0,-1));
        }
    },
    sliderChangeCallback:[],
    sliderChange:function(callback){
        if(callback){
            $(this).sliderChangeCallback.push(callback);
        }
    },
    sliderClickCallback:[],
    sliderClick:function(callback){
        if(callback){
            $(this).sliderClickCallback.push(callback);
        }
    }
});