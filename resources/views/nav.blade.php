<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="/lib/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/lib/font-awesome/css/font-awesome.min.css">
    @section("css_lib")
    @show
    @section("css")
        <style>
            body{margin:0px;padding: 0px;background: #f0f0f0;color:#393939;}
            .topBar{background:white;height:60px;border-bottom: 1px solid #cfcfcf;padding:0 100px 0 30px;}
            .topBar-item{float:left;height: 100%;margin:0 10px;}
            .topBar-item.right{float:right;}
            .topBar-item.align-center{display: flex;align-items: center;justify-content: center}
            .logo{width:auto;height:100%;}
            .logo:hover{cursor:pointer;}
            .logo-text{font-size: 1.8em;font-weight: bold;text-shadow: 2px 2px 2px grey;}
            .search-frame{border:3px solid red;background:red;}
            .search{border:none;outline:none;padding:5px 0 5px 5px;}
            .search-btn{padding:5px;color:white;cursor:pointer;}
            .search-btn:hover{color:#cfcfcf;}
        </style>
    @show
</head>
<body>
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <nav class="topBar">
        <div class="topBar-item align-center">
            <img src="/img/logo.svg" class="logo" onclick="location.href='/main'">
            <span class="logo-text">动画电影网</span>
        </div>
        <div class="topBar-item right align-center">
            <span class="search-frame">
                <input type="search" class="search" placeholder="快来搜一搜吧！">
                <span class="search-btn">搜索</span>
            </span>
        </div>
    </nav>
    @yield("main")
    @section("js_lib")
        <script src="/lib/ladda/dist/spin.min.js"></script>
        <script src="/lib/ladda/dist/ladda.min.js"></script>
    @show
    @section("js")
        <script>
            $(".topBar").on("dragstart",function(){return false;});
            $(".topBar").on("selectstart",function(){return false;});
            $(".search-btn").click(function(){
                var key=$(".search").val();
                console.log(key);
                if(key==null||key=="") return;
                open("/search?key="+key,"_blank");
            })
        </script>
    @show
</body>
</html>
