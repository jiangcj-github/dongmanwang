<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
    <style>
        body{margin:0px;padding: 0px;background: #f0f0f0;color:#393939;}
        .topBar{background:white;height:60px;border-bottom: 1px solid #cfcfcf;display:flex;padding-right:20px;}
        .topBar-iconBtn{color:#393939 !important;width:50px;height:60px;
            display:flex;align-items:center;justify-content:center;font-size:1.5em;text-decoration:none !important;}
        .topBar-iconBtn:active{background:#cfcfcf;}
        .search_group{flex-grow:1;display:flex;align-items:center;}
        .search{border:none;outline:none;width:100%;border-bottom:1px solid #cfcfcf;line-height:30px;font-size:1.2em;padding-right:30px;}
        .search-btn{font-size:1.2em;margin-left:-30px;width:30px;height:100%;display: flex;align-items: center;justify-content:center;}

        .content{text-align: center;padding: 50px;font-weight: bold;}
    </style>
</head>
<body>
<script src="/lib/jquery/dist/jquery.min.js"></script>
<script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
<nav class="topBar">
    <a href="javascript:void(0);" onclick="window.history.back();" class="topBar-iconBtn"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="search_group">
        <input type="search" class="search" placeholder="搜索">
        <i class="glyphicon glyphicon-search search-btn"></i>
    </div>
</nav>
<div class="content">
    动漫视频名称，作者，地区，或者其他相关信息
</div>

<script>
    $(".search-btn").click(function(){
        var key=$(".search").val();
        if(key==null||/^\s*$/.test(key)) return;
        location.href="/search?key="+key;
    });
</script>

</body>
</html>
