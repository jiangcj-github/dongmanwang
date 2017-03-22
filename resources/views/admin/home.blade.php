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
    </style>
@append
@section("main")
    <div class="content">
        <div class="section">
            <div class="section-header">上传视频</div>
            <div class="section-content">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                </div>
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
                    <input type="text" class="form-control" id="name" name="name"/>
                </div>
                <div class="form-group">
                    <label for="name">Author</label>
                    <input type="text" class="form-control" id="name" name="name"/>
                </div>
                <div class="form-group">
                    <label for="name">Categery</label>
                    <select class="form-control">
                        @foreach($categery as $key=>$value)
                            <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="file">上传视频</label>
                    <input type="file" id="file" />
                    <p class="help-block">
                        只支持mp4格式
                    </p>
                </div>
                <button type="submit" class="btn btn-primary">上传</button>
            </div>
        </div>
        <div class="section">
            <div class="section-header">视频分类</div>
            <div class="section-content">
               <table class="table table-hover table-bordered">
                   <thead><tr><th>id</th><th>name</th><th>操作</th></tr></thead>
                   <tbody>
                        @foreach($categery as $key=>$value)
                           <tr>
                               <td>{!! $value->id !!}</td>
                               <td>{!! $value->name !!}</td>
                               <td>
                                   <button class="btn btn-primary btn-xs" style="display:none;" onclick="renameCat('{!! $value->id !!}',this);">保存</button>
                                   <button class="btn btn-default btn-xs" style="display:none;" onclick="cancelRenameCat(this);">取消</button>
                                   <button class="btn btn-default btn-xs" onclick="startRenameCat(this);">重命名</button>
                                   <button class="btn btn-default btn-xs" onclick="deleteCat('{!! $value->id !!}');">删除</button>
                               </td>
                           </tr>
                        @endforeach
                        <tr id="ncat" style="display:none;">
                            <td></td>
                            <td contenteditable id="ncatv_name"></td>
                            <td>
                                <button class="btn btn-primary btn-xs" id="ncat_save">保存</button>
                                <button class="btn btn-default btn-xs" data-target="ncat" id="ncat_cancel">取消</button>
                            </td>
                        </tr>
                   </tbody>
               </table>
                <button class="btn btn-primary" data-target="ncat" id="ncat_btn">添加</button>
            </div>
        </div>
    </div>
@append
@section("js")
    @parent
    <script>
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
                    alert(data.msg);
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
                    alert(data.msg);
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
                   alert(data.msg);
               }
            });
        }

    </script>
@append
