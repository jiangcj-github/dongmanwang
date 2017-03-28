@extends("nav")
@section("title","视频管理")
@section("css")
    @parent
    <style>
        .content{padding:20px 50px;}
        .section{background: white;border:1px solid #cfcfcf;;margin-bottom:20px;}
        .section-header{font-size:1.2em;line-height:2.4;padding:0 15px;border-bottom:1px solid #cfcfcf;font-weight:bold;}
        .section-header a{text-decoration:none !important;}
        .section-content{padding:20px 50px;}

        table td[contenteditable]{background:lightblue;outline: none;width: 500px;}
        .table-header{margin:10px 0;}
        .table-header select{height:22px; line-height:18px; padding:2px 0;width:80px;box-sizing:content-box;vertical-align:middle;}
        .table-footer{margin:10px 0;padding-right:20px;text-align:right;}
        .table-footer>span{margin:0 2px;letter-spacing: 1px;}
        .table-footer>button{margin:0 2px;}
        input[type=checkbox]:hover{cursor:pointer;}
    </style>
@append
@section("main")
    <div class="content">
        <div class="section">
            <div class="section-header"><a href="/admin/home">管理中心</a>&nbsp;>&nbsp;视频管理</div>
        </div>
        <div class="section">
            <div class="section-header">视频列表</div>
            <div class="section-content" id="v">
                <div class="alert alert-warning" id="v_error" style="display:none;">
                    <a href="javascript:void(0);" onclick="$(this).parent().hide();" class="close">&times;</a>
                    <span></span>
                </div>
                <div class="table-header">
                    <button class="btn btn-warning btn-xs" id="v_btn_sel">全选</button>
                    <button class="btn btn-warning btn-xs" id="v_btn_usel">取消</button>
                    <button class="btn btn-warning btn-xs" onclick="deleteVs()">删除</button>
                    <label style="margin-left:10px;">Categery:</label>
                    <select id="srch_cat">
                        @if($srch_cat==-1)
                            <option value="-1" selected>全部</option>
                        @else
                            <option value="-1">全部</option>
                        @endif
                        @foreach($categery as $key=>$value)
                            @if($srch_cat==$value->id)
                                <option value="{!! $value->id !!}" selected>{!! $value->name !!}</option>
                            @else
                                <option value="{!! $value->id !!}">{!! $value->name !!}</option>
                            @endif
                        @endforeach
                    </select>
                    <button class="btn btn-warning btn-xs" onclick="filterVs()">过滤</button>
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>id</th>
                            <th>name</th>
                            <th>duration</th>
                            <th>firstshow</th>
                            <th>author</th>
                            <th>nation</th>
                            <th>categery.name</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($video as $key=>$value)
                        <tr>
                            <td><input type="checkbox" value="{!! $value->id !!}"></td>
                            <td>{!! $value->id !!}</td>
                            <td>{!! $value->name !!}</td>
                            <td>{!! $value->duration !!}</td>
                            <td>{!! $value->firstshow !!}</td>
                            <td>{!! $value->author !!}</td>
                            <td>{!! $value->nation !!}</td>
                            <td>{!! $value->cat_name !!}</td>
                            <td>
                                <button class="btn btn-default btn-xs" onclick="deleteV('{!! $value->id !!}');">删除</button>
                                <button class="btn btn-default btn-xs" onclick="location.href='/admin/video/update?id={!! $value->id !!}'">修改</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="table-footer">
                    <span id="v_span_sel" style="float:left">选中0项</span>
                    <span style="float:left">共{!! count($video) !!}项</span>
                    <span>第{!! $v_page !!}页</span>
                    <span>共{!! ceil($v_count/20) !!}页</span>
                    @if($v_page<=1)
                        <button class="btn btn-warning btn-xs" disabled>上一页</button>
                    @else
                        <button class="btn btn-warning btn-xs">上一页</button>
                    @endif
                    @if($v_page>=ceil($v_count/20))
                        <button class="btn btn-warning btn-xs" disabled>下一页</button>
                    @else
                        <button class="btn btn-warning btn-xs">下一页</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@append
@section("js")
    @parent
    <script>

        //delete
        function deleteV(id){
            var _token="{!! csrf_token() !!}";
            $.post("/admin/videoManage/deleteV",{id:id,_token:_token},function(data){
                if(!data.msg){
                    location.reload();
                } else{
                    $("#v_error").show();
                    $("#v_error").children("span").text(data.msg);
                }
            });
        }
        function deleteVs(){
            var ids=[];
            $("#v table tr input[type=checkbox]:checked").each(function(i,e){
                ids.push($(e).val());
            });
            var _token="{!! csrf_token() !!}";
            $.post("/admin/videoManage/deleteVs",{ids:ids.join("-"),_token:_token},function(data){
                if(!data.msg){
                    location.reload();
                } else{
                    $("#v_error").show();
                    $("#v_error").children("span").text(data.msg);
                }
            });
        }
        //sel
        $("#v_btn_sel").click(function(){
            $("#v table").find("input[type=checkbox]").prop("checked",true);
            $("#v_span_sel").text("选中"+$("#v table tr input[type=checkbox]:checked").length+"项");
        });
        $("#v_btn_usel").click(function(){
            $("#v table").find("input[type=checkbox]").prop("checked",false);
            $("#v_span_sel").text("选中"+$("#v table tr input[type=checkbox]:checked").length+"项");
        });
        $("#v table tr input[type=checkbox]").change(function(){
            $("#v_span_sel").text("选中"+$("#v table tr input[type=checkbox]:checked").length+"项");
        });
        //
        function filterVs(){
            var srch_cat=$("#srch_cat").val();
            location.href="/admin/videoManage?srch_cat="+srch_cat;
        }
    </script>
@append
