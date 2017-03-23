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
    </style>
@append
@section("main")
    <div class="content">
        <div class="section" id="cat">
            <div class="section-header">视频列表</div>
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
                    @foreach($video as $key=>$value)
                        <tr>
                            <td><input type="checkbox" value="{!! $value->id !!}"></td>
                            <td>{!! $value->id !!}</td>
                            <td>{!! $value->name !!}</td>
                            <td>
                                <button class="btn btn-default btn-xs" onclick="deleteCat('{!! $value->id !!}');">删除</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="table-footer">
                    <span id="scat_selnum" style="float:left">选中0项</span>
                    <span id="scat_selnum" style="float:left">共{!! count($video) !!}项</span>
                    <span>第{!! floor($v_offset/$v_limit)+1 !!}页</span>
                    <span>共{!! ceil($v_count/$v_limit) !!}页</span>
                    @if(floor($cat_offset/$cat_limit)<=0)
                        <button class="btn btn-warning btn-xs" disabled>上一页</button>
                    @else
                        <button class="btn btn-warning btn-xs">上一页</button>
                    @endif
                    @if(floor($cat_offset/$cat_limit)+1==ceil($v_count/$v_limit))
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
            $("#cat table").find("input[type=checkbox]").attr("checked",true);
            $("#scat_selnum").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
        $("#scat_usel").click(function(){
            $("#cat table").find("input[type=checkbox]").attr("checked",false);
            $("#scat_selnum").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
        $("#cat table tr input[type=checkbox]").change(function(){
            $("#scat_selnum").text("选中"+$("#cat table tr input[type=checkbox]:checked").length+"项");
        });
        //show
        function showCat(id){
            open("/admin/videoList?cat_id="+id,"_blank");
        }
        //
    </script>
@append
