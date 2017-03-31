@extends("mobile/nav")
@section("title","管理中心")
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
        table td[contenteditable]{background:lightblue;outline: none;width: 500px;}
        .table-header{margin:10px 0;}
        .table-footer{margin:10px 0;padding-right:20px;text-align:right;}
        .table-footer>span{margin:0 2px;letter-spacing: 1px;}
        .table-footer>button{margin:0 2px;}
        input[type=checkbox]:hover{cursor:pointer;}

        .poster{width:150px;}
        .poster img{width:150px;height:200px;border:1px solid gray;}
        .poster img:hover{cursor:pointer;border:1px solid darkgray;}
        .progress{height:5px;background: #cfcfcf;border-radius:0;margin-bottom:0;}
        .video{width:240px;}
        .video img{width:240px;height:140px;border:1px solid gray;}
        .video img:hover{cursor:pointer;border:1px solid darkgray;}
    </style>
@stop
@section("main")
    <div class="content">
        <div class="section">
            <div class="section-header">管理中心</div>
        </div>
        <div class="section">
            <div class="section-header">上传视频</div>
            <div class="section-content">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="v_input_name"/>
                </div>
                <div class="form-group">
                    <label>First Show</label>
                    <div class="ymd-group">
                        <select class="ymd" id="v_input_firstshow_y">
                            @foreach(range(1970,2030) as $value)
                                <option value="{!! $value !!}">{!! $value !!}年</option>
                            @endforeach
                        </select>
                        <select class="ymd" id="v_input_firstshow_m">
                            @foreach(range(1,12) as $value)
                                @if($value<10)
                                    <option value="0{!! $value !!}">0{!! $value !!}月</option>
                                @else
                                    <option value="{!! $value !!}">{!! $value !!}月</option>
                                @endif
                            @endforeach
                        </select>
                        <select class="ymd" id="v_input_firstshow_d">
                            @foreach(range(1,31) as $value)
                                @if($value<10)
                                    <option value="0{!! $value !!}">0{!! $value !!}日</option>
                                @else
                                    <option value="{!! $value !!}">{!! $value !!}日</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nation</label>
                    <input type="text" class="form-control" id="v_input_nation"/>
                </div>
                <div class="form-group">
                    <label>Author</label>
                    <input type="text" class="form-control" id="v_input_author"/>
                </div>
                <div class="form-group">
                    <label>Categery</label>
                    <select class="form-control" id="v_input_categery">
                        @foreach($categerys as $key=>$value)
                            <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Poster</label>
                    <div class="poster">
                        <img src="/img/upload1.png" onclick="$('#poster').click();">
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
                        <img src="/img/upload2.png" onclick="$('#video').click();">
                        <input type="file" id="video" style="display: none;"/>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning progress-bar-striped" style="width:0;"></div>
                        </div>
                    </div>
                    <p class="help-block">
                        必须为mp4格式
                    </p>
                </div>
                <div class="alert alert-warning" id="upload_error" style="display:none;">
                    <a href="javascript:void(0);" onclick="$(this).parent().hide();" class="close">&times;</a>
                    <span></span>
                </div>
                <button class="btn btn-primary" id="v_btn_submit">提交</button>
            </div>
        </div>
        <div class="section" id="cat">
            <div class="section-header">视频分类</div>
            <div class="section-content">
                <div class="alert alert-warning" id="cat_error" style="display:none;">
                    <a href="javascript:void(0);" onclick="$(this).parent().hide();" class="close">&times;</a>
                    <span></span>
                </div>
                <div class="table-header">
                    <button class="btn btn-warning btn-xs" id="cat_btn_sel">全选</button>
                    <button class="btn btn-warning btn-xs" id="cat_btn_usel">取消</button>
                    <button class="btn btn-warning btn-xs" onclick="deleteCats()">删除</button>
                </div>
                <table class="table table-hover table-bordered">
                   <thead><tr><th></th><th>id</th><th>name</th><th>操作</th></tr></thead>
                   <tbody>
                        @foreach($categery as $key=>$value)
                           <tr>
                               <td><input type="checkbox" value="{!! $value->id !!}"></td>
                               <td>{!! $value->id !!}</td>
                               <td>{!! $value->name !!}</td>
                               <td>
                                   @if($value->id!=0)
                                       <button class="btn btn-primary btn-xs" style="display:none;" onclick="renameCat('{!! $value->id !!}',this);">保存</button>
                                       <button class="btn btn-default btn-xs" style="display:none;" onclick="cancelRenameCat(this);">取消</button>
                                       <button class="btn btn-default btn-xs" onclick="startRenameCat(this);">重命名</button>
                                       <button class="btn btn-default btn-xs" onclick="deleteCat('{!! $value->id !!}');">删除</button>
                                       <button class="btn btn-default btn-xs" onclick="location.href='/admin/video?srch_cat={!! $value->id !!}'">详细</button>
                                   @endif
                               </td>
                           </tr>
                        @endforeach
                        <tr id="ncat" style="display:none;">
                            <td></td>
                            <td></td>
                            <td contenteditable id="cat_input_name"></td>
                            <td>
                                <button class="btn btn-primary btn-xs" id="cat_btn_save">保存</button>
                                <button class="btn btn-default btn-xs" data-target="ncat" id="cat_btn_cancel">取消</button>
                            </td>
                        </tr>
                   </tbody>
               </table>
                <div class="table-footer">
                    <span id="cat_span_sel" style="float:left">选中0项</span>
                    <span style="float:left">共{!! count($categery) !!}项</span>
                    <span>第{!! $cat_page !!}页</span>
                    <span>共{!! ceil($cat_count/10) !!}页</span>
                    @if($cat_page<=1)
                        <button class="btn btn-warning btn-xs" disabled>上一页</button>
                    @else
                        <button class="btn btn-warning btn-xs" onclick="location.href='/admin/home?cat_page={!! $cat_page-1 !!}';">上一页</button>
                    @endif
                    @if($cat_page>=ceil($cat_count/10))
                        <button class="btn btn-warning btn-xs" disabled>下一页</button>
                    @else
                        <button class="btn btn-warning btn-xs" onclick="location.href='/admin/home?cat_page={!! $cat_page+1 !!}';">下一页</button>
                    @endif
                </div>
                <button class="btn btn-primary" data-target="ncat" id="cat_btn_add">添加</button>
            </div>
        </div>
        <div class="section">
            <div class="section-header">视频管理</div>
            <div class="section-content">
                <button class="btn btn-primary" onclick="location.href='/admin/video'">管理</button>
            </div>
        </div>
    </div>
@stop
@section("js")
    @parent
    <script>
        //upload
        var posterUploaded=false;
        var videoUploaded=false;
        $("#poster").change(function(){
            var formData = new FormData();
            formData.append("file", $("#poster")[0].files[0]);
            formData.append("_token","{!! csrf_token() !!}");
            $.ajax({
                url: "/admin/home/uploadPoster",
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
                        posterUploaded=false;
                    }else{
                        $(".poster img").prop("src",data.url);
                        posterUploaded=true;
                    }
                },
                error:function(){
                    $("#upload_error").show();
                    $("#upload_error").children("span").text("文件"+$("#poster")[0].files[0].name+"上传失败");
                    posterUploaded=false;
                }
            });
        });

        $("#video").change(function(){
            var formData = new FormData();
            formData.append("file", $("#video")[0].files[0]);
            formData.append("_token","{!! csrf_token() !!}");
            $.ajax({
                url: "/admin/home/uploadVideo",
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
           if(!videoUploaded&&!posterUploaded){
               $("#upload_error").show();
               $("#upload_error").children("span").text("Poster或Video未上传");
               return;
           }
           $.post("/admin/home/addVideo",{name:name,nation:nation,author:author,categery:categery,firstshow:firstshow,_token:_token},function(data){
                if(data.msg){
                    $("#upload_error").show();
                    $("#upload_error").children("span").text("提交失败，错误: "+data.msg);
                }else{
                    location.reload();
                }
           });
        });

        //categery
        $("#cat_btn_add").click(function(){
            $("#"+$(this).data("target")).show();
        });
        $("#cat_btn_cancel").click(function(){
            $("#"+$(this).data("target")).hide();
        });
        //save
        $("#cat_btn_save").click(function(){
           var name=$("#cat_input_name").text();
           var _token="{!! csrf_token() !!}";
           $.post("/admin/home/addCategery",{name:name,_token:_token},function(data){
                if(!data.msg){
                    location.reload();
                }else{
                    $("#cat_error").show();
                    $("#cat_error").children("span").text(data.msg);
                }
           });
        });
        //rename
        function startRenameCat(e){
            $(e).parent("td").prev().attr("contenteditable","true");
            $(e).prevAll().show();
            $(e).hide();
            $(e).nextAll().hide();
        }
        function cancelRenameCat(e){
            $(e).parent("td").prev().removeAttr("contenteditable");
            $(e).prevAll().hide();
            $(e).hide();
            $(e).nextAll().show();
        }
        function renameCat(id,e){
            var name=$(e).parent("td").prev().text();
            var _token="{!! csrf_token() !!}";
            $.post("/admin/home/renameCategery",{id:id,name:name,_token:_token},function(data){
                if(!data.msg){
                    location.reload();
                } else{
                    $("#cat_error").show();
                    $("#cat_error").children("span").text(data.msg);
                }
            });
        }
        //delte
        function deleteCat(id){
            var _token="{!! csrf_token() !!}";
            $.post("/admin/home/deleteCategery",{id:id,_token:_token},function(data){
               if(!data.msg){
                   location.reload();
               } else{
                   $("#cat_error").show();
                   $("#cat_error").children("span").text(data.msg);
               }
            });
        }
        function deleteCats(){
            var ids=[];
            $("#cat table tr input[type=checkbox]:checked").each(function(i,e){
               ids.push($(e).val());
            });
            var _token="{!! csrf_token() !!}";
            $.post("/admin/home/deleteCategerys",{ids:ids.join("-"),_token:_token},function(data){
                if(!data.msg){
                    location.reload();
                } else{
                    $("#cat_error").show();
                    $("#cat_error").children("span").text(data.msg);
                }
            });
        }
        //sel
        $("#cat_btn_sel").click(function(){
            $("#cat table").find("input[type=checkbox]").prop("checked",true);
            $("#cat_span_sel").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
        $("#cat_btn_usel").click(function(){
            $("#cat table").find("input[type=checkbox]").prop("checked",false);
            $("#cat_span_sel").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
        $("#cat table tr input[type=checkbox]").change(function(){
            $("#cat_span_sel").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
    </script>
@stop
