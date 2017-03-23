@extends("nav")
@section("title","动画电影网")
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
        .progress{height:5px;background: #cfcfcf;border-radius: 0;}
        .video{width:240px;}
        .video img{width:240px;height:140px;border:1px solid gray;}
        .video img:hover{cursor:pointer;border:1px solid darkgray;}
    </style>
@append
@section("main")
    <div class="content">
        <div class="section">
            <div class="section-header">上传视频</div>
            <div class="section-content">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                </div>
                <div class="form-group">
                    <label for="name">First Show</label>
                    <div class="ymd-group">
                        <select class="ymd">
                            @foreach(range(1970,2030) as $value)
                                <option value="{!! $value !!}">{!! $value !!}年</option>
                            @endforeach
                        </select>
                        <select class=" ymd">
                            @foreach(range(1,12) as $value)
                                <option value="{!! $value !!}">{!! $value !!}月</option>
                            @endforeach
                        </select>
                        <select class=" ymd">
                            @foreach(range(1,31) as $value)
                                <option value="{!! $value !!}">{!! $value !!}日</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Nation</label>
                    <input type="text" class="form-control" id="name" name="nation"/>
                </div>
                <div class="form-group">
                    <label for="name">Author</label>
                    <input type="text" class="form-control" id="name" name="author"/>
                </div>
                <div class="form-group">
                    <label for="name">Categery</label>
                    <select class="form-control">
                        <option value="0">无</option>
                        @foreach($categery as $key=>$value)
                            <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Poster</label>
                    <div class="poster">
                        <img src="/img/upload1.png" onclick="$('#poster').click();">
                        <input type="file" id="poster" name="poster" style="display: none;"/>
                        <div class="progress">
                            <div class="progress-bar" style="width:0;"></div>
                        </div>
                    </div>
                    <p class="help-block">
                        支持png或jpg格式
                    </p>
                </div>
                <div class="form-group">
                    <label>视频文件</label>
                    <div class="video">
                        <img src="/img/upload2.png" onclick="$('#video').click();">
                        <input type="file" id="video" name="video" style="display: none;"/>
                        <div class="progress">
                            <div class="progress-bar" style="width:0;"></div>
                        </div>
                    </div>
                    <p class="help-block">
                        只支持mp4格式
                    </p>
                </div>
                <div class="alert alert-warning" id="upload_error" style="display:none;"></div>
                <button type="submit" class="btn btn-primary">提交</button>
            </div>
        </div>
        <div class="section" id="cat">
            <div class="section-header">视频分类</div>
            <div class="section-content">
                <div class="alert alert-warning" id="cat_info" style="display:none;"></div>
                <div class="table-header">
                    <button class="btn btn-warning btn-xs" id="scat_sel">全选</button>
                    <button class="btn btn-warning btn-xs" id="scat_usel">取消</button>
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
                                   <button class="btn btn-primary btn-xs" style="display:none;" onclick="renameCat('{!! $value->id !!}',this);">保存</button>
                                   <button class="btn btn-default btn-xs" style="display:none;" onclick="cancelRenameCat(this);">取消</button>
                                   <button class="btn btn-default btn-xs" onclick="startRenameCat(this);">重命名</button>
                                   <button class="btn btn-default btn-xs" onclick="deleteCat('{!! $value->id !!}');">删除</button>
                                   <button class="btn btn-default btn-xs" onclick="showCat('{!! $value->id !!}');">详细</button>
                               </td>
                           </tr>
                        @endforeach
                        <tr id="ncat" style="display:none;">
                            <td></td>
                            <td></td>
                            <td contenteditable id="ncatv_name"></td>
                            <td>
                                <button class="btn btn-primary btn-xs" id="ncat_save">保存</button>
                                <button class="btn btn-default btn-xs" data-target="ncat" id="ncat_cancel">取消</button>
                            </td>
                        </tr>
                   </tbody>
               </table>
                <div class="table-footer">
                    <span id="scat_selnum" style="float:left">选中0项</span>
                    <span id="scat_selnum" style="float:left">共{!! count($categery) !!}项</span>
                    <span>第{!! floor($cat_offset/$cat_limit)+1 !!}页</span>
                    <span>共{!! ceil($cat_count/$cat_limit) !!}页</span>
                    @if(floor($cat_offset/$cat_limit)<=0)
                        <button class="btn btn-warning btn-xs" disabled>上一页</button>
                    @else
                        <button class="btn btn-warning btn-xs" id="pcat_up">上一页</button>
                    @endif
                    @if(floor($cat_offset/$cat_limit)+1>=ceil($cat_count/$cat_limit))
                        <button class="btn btn-warning btn-xs" disabled>下一页</button>
                    @else
                        <button class="btn btn-warning btn-xs" id="pcat_down">下一页</button>
                    @endif
                </div>
                <button class="btn btn-primary" data-target="ncat" id="ncat_btn">添加</button>
            </div>
        </div>
    </div>
@append
@section("js")
    @parent
    <script>
        //upload
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
                    $(".poster img").prop("src",data.url);
                },
                error:function(){
                    $("#upload_error").show();
                    $("#upload_error").text("文件"+$("#poster")[0].files[0].name+"上传失败");
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
                    $(".video img").prop("src",data.url);
                },
                error:function(){
                    $("#upload_error").show();
                    $("#upload_error").text("文件"+$("#video")[0].files[0].name+"上传失败");
                }
            });
        });

        //categery
        $("#ncat_btn").click(function(){
            $("#"+$(this).data("target")).show();
        });
        $("#ncat_cancel").click(function(){
            $("#"+$(this).data("target")).hide();
        });
        //save
        $("#ncat_save").click(function(){
           var name=$("#ncatv_name").text();
           var _token="{!! csrf_token() !!}";
           $.post("/admin/home/addCategery",{name:name,_token:_token},function(data){
                if(!data.msg){
                    location.reload();
                }else{
                    $("#cat_info").show();
                    $("#cat_info").text(data.msg);
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
                    $("#cat_info").show();
                    $("#cat_info").text(data.msg);
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
                   $("#cat_info").show();
                   $("#cat_info").text(data.msg);
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
                    $("#cat_info").show();
                    $("#cat_info").text(data.msg);
                }
            });
        }
        //sel
        $("#scat_sel").click(function(){
            $("#cat table").find("input[type=checkbox]").prop("checked",true);
            $("#scat_selnum").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
        $("#scat_usel").click(function(){
            $("#cat table").find("input[type=checkbox]").prop("checked",false);
            $("#scat_selnum").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
        $("#cat table tr input[type=checkbox]").change(function(){
            $("#scat_selnum").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
        //show
        function showCat(id){
            open("/admin/videoList?cat_id="+id,"_blank");
        }
        //page
        $("#pcat_up").click(function(){
            location.href="/admin/home?cat_limit={!! $cat_limit !!}&cat_offset={!! $cat_offset-$cat_limit !!}";
        });
        $("#pcat_down").click(function(){
            location.href="/admin/home?cat_limit={!! $cat_limit !!}&cat_offset={!! $cat_offset+$cat_limit !!}";
        });
    </script>
@append
