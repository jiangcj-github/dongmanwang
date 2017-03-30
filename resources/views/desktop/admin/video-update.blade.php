@extends("desktop/nav")
@section("title","更新视频")
@section("css")
    @parent
    <style>
        .content{padding:20px 50px;}
        .section{background: white;border:1px solid #cfcfcf;;margin-bottom:20px;}
        .section-header{font-size:1.2em;line-height:2.4;padding:0 15px;border-bottom:1px solid #cfcfcf;font-weight:bold;}
        .section-content{padding:20px 50px;}
        .section-content .form-control{max-width:300px;}
        .ymd-group{height:40px;display:flex;align-items:center;}
        .ymd{padding: 3px;box-sizing:content-box;border-radius:3px;margin:0 2px;height:22px;border:1px solid #ccc;}
        .poster{width:150px;}
        .poster img{width:150px;height:200px;border:1px solid gray;}
        .poster img:hover{cursor:pointer;border:1px solid darkgray;}
        .progress{height:5px;background: #cfcfcf;border-radius:0;margin-bottom:0;}
        .video{width:240px;}
        .video img{width:240px;height:140px;border:1px solid gray;}
        .video img:hover{cursor:pointer;border:1px solid darkgray;}
        .slider{max-width:300px;}
    </style>
@stop
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/plugin.css">
@stop
@section("main")
    <div class="content">
        <div class="section">
            <div class="section-header"><a href="/admin/home">管理中心</a>&nbsp;>&nbsp;<a href="/admin/video">视频管理</a>&nbsp;>&nbsp;更新视频</div>
        </div>
        <div class="section">
            <div class="section-header">更新视频信息</div>
            <div class="section-content">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="v_input_name" value="{!! $video->name !!}"/>
                </div>
                <div class="form-group">
                    <label>First Show</label>
                    <div class="ymd-group">
                        <select class="ymd" id="v_input_firstshow_y">
                            @foreach(range(1970,2030) as $value)
                                @if($ymd[0]=="".$value)
                                    <option value="{!! $value !!}" selected>{!! $value !!}年</option>
                                @else
                                    <option value="{!! $value !!}">{!! $value !!}年</option>
                                @endif
                            @endforeach
                        </select>
                        <select class=" ymd" id="v_input_firstshow_m">
                            @foreach(range(1,12) as $value)
                                @if($value<10)
                                    @if($ymd[1]=="0".$value)
                                        <option value="0{!! $value !!}" selected>0{!! $value !!}月</option>
                                    @else
                                        <option value="0{!! $value !!}">0{!! $value !!}月</option>
                                    @endif
                                @else
                                    @if($ymd[1]=="".$value)
                                        <option value="{!! $value !!}" selected>{!! $value !!}月</option>
                                    @else
                                        <option value="{!! $value !!}">{!! $value !!}月</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                        <select class=" ymd" id="v_input_firstshow_d">
                            @foreach(range(1,31) as $value)
                                @if($value<10)
                                    @if($ymd[2]=="0".$value)
                                        <option value="0{!! $value !!}" selected>0{!! $value !!}日</option>
                                    @else
                                        <option value="0{!! $value !!}">0{!! $value !!}日</option>
                                    @endif
                                @else
                                    @if($ymd[2]=="".$value)
                                        <option value="{!! $value !!}" selected>{!! $value !!}日</option>
                                    @else
                                        <option value="{!! $value !!}">{!! $value !!}日</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nation</label>
                    <input type="text" class="form-control" id="v_input_nation" value="{!! $video->nation !!}"/>
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control" id="v_input_author" value="{!! $video->author !!}"/>
                </div>
                <div class="form-group">
                    <label>Categery</label>
                    <select class="form-control" id="v_input_categery">
                        @foreach($categerys as $key=>$value)
                            @if($video->categery==$value->id)
                                <option value="{!! $value->id !!}" selected>{!! $value->name !!}</option>
                            @else
                                <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Poster</label>
                    <div class="poster">
                        <img src="/data/video/poster/{!! $video->id !!}.png" onclick="$('#poster').click();">
                        <input type="file" id="poster" style="display: none;"/>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" style="width:0;"></div>
                        </div>
                    </div>
                    <p class="help-block">
                        必须为png格式
                    </p>
                </div>
                <div class="form-group">
                    <label>视频文件</label>
                    <div class="video">
                        <img src="/data/video/frame/{!! $video->id !!}.jpg" onclick="$('#video').click();">
                        <input type="file" id="video" style="display: none;"/>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" style="width:0;"></div>
                        </div>
                    </div>
                    <p class="help-block">
                        必须为mp4格式
                    </p>
                </div>
                <div class="form-group">
                    <label>Frame</label>
                    <div class="slider" id="v_slider_frame">
                        <div class="slider-btn" style="left:20%;"></div>
                        <span class="slider-value">20%</span>
                    </div>
                </div>
                <div class="alert alert-warning" id="upload_error" style="display:none;">
                    <a href="javascript:void(0);" onclick="$(this).parent().hide();" class="close">&times;</a>
                    <span></span>
                </div>
                <button class="btn btn-primary" id="v_btn_submit">保存</button>
            </div>
        </div>
    </div>
@stop
@section("js_lib")
    @parent
    <script src="/js/plugin.js"></script>
@stop
@section("js")
    @parent
    <script>
        //upload
        $("#poster").change(function(){
            var formData = new FormData();
            formData.append("id","{!! $video->id !!}")
            formData.append("file", $("#poster")[0].files[0]);
            formData.append("_token","{!! csrf_token() !!}");
            $.ajax({
                url: "/admin/video/update/uploadPoster",
                type: "POST",
                data: formData,
                contentType:false,
                processData:false,
                xhr:function(){
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){
                        myXhr.upload.addEventListener('progress',function(e){
                            if (e.lengthComputable) {
                                var per = e.loaded/e.total*100;
                                $(".poster .progress-bar").css("width",per+"%");
                            }
                        },false);
                    }
                    return myXhr;
                },
                success: function(data){
                    if(data.msg){
                        $("#upload_error").show();
                        $("#upload_error").children("span").text("文件"+$("#poster")[0].files[0].name+"上传失败，"+data.msg);
                    }else{
                        $(".poster img").prop("src",data.url);
                    }
                },
                error:function(){
                    $("#upload_error").show();
                    $("#upload_error").children("span").text("文件"+$("#poster")[0].files[0].name+"上传失败");
                }
            });
        });

        $("#video").change(function(){
            var formData = new FormData();
            formData.append("id","{!! $video->id !!}")
            formData.append("file", $("#video")[0].files[0]);
            formData.append("_token","{!! csrf_token() !!}");
            $.ajax({
                url: "/admin/video/update/uploadVideo",
                type: "POST",
                data: formData,
                contentType:false,
                processData:false,
                xhr:function(){
                    myXhr = $.ajaxSettings.xhr();
                    if(myXhr.upload){
                        myXhr.upload.addEventListener('progress',function(e){
                            if (e.lengthComputable) {
                                var per = e.loaded/e.total*100;
                                $(".video .progress-bar").css("width",per+"%");
                            }
                        },false);
                    }
                    return myXhr;
                },
                success: function(data){
                    if(data.msg){
                        $("#upload_error").show();
                        $("#upload_error").children("span").text("文件"+$("#video")[0].files[0].name+"上传失败，"+data.msg);
                        videoUploaded=false;
                    }else{
                        $(".video img").prop("src",data.url);
                        videoUploaded=true;
                    }
                },
                error:function(){
                    $("#upload_error").show();
                    $("#upload_error").children("span").text("文件"+$("#video")[0].files[0].name+"上传失败");
                    videoUploaded=false;
                }
            });
        });

        $("#v_btn_submit").click(function(){
            var name=$("#v_input_name").val();
            if(name==null||name==""){
                $("#upload_error").show();
                $("#upload_error").children("span").text("name为空");
                return;
            }
            var nation=$("#v_input_nation").val();
            if(nation==null||nation==""){
                $("#upload_error").show();
                $("#upload_error").children("span").text("nation为空");
                return;
            }
            var author=$("#v_input_author").val();
            if(author==null||author==""){
                $("#upload_error").show();
                $("#upload_error").children("span").text("author为空");
                return;
            }
            var categery=$("#v_input_categery").val();
            var firstshow=$("#v_input_firstshow_y").val()+"-"+$("#v_input_firstshow_m").val()+"-"+$("#v_input_firstshow_d").val();
            var _token="{!! csrf_token() !!}";
            var id=parseInt("{!! $video->id !!}");
            $.post("/admin/video/update/updateVideo",{id:id,name:name,nation:nation,author:author,categery:categery,firstshow:firstshow,_token:_token},function(data){
                if(data.msg){
                    $("#upload_error").show();
                    $("#upload_error").children("span").text("提交失败，错误: "+data.msg);
                }else{
                    location.reload();
                }
            });
        });

        $("#v_slider_frame").sliderClick(function(per){
            $.get("/admin/video/update/updateVideoFrame?id={!! $video->id !!}&per="+per,function(data){
                if(!data.msg){
                    $(".video img").prop("src",data.url+"?"+Math.random());
                }
            });
        });
    </script>
@stop
