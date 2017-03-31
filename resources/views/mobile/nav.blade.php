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
            .topBar{background:white;height:50px;border-bottom: 1px solid #cfcfcf;padding:0 20px;}
            .topBar-item{float:left;height: 100%;}
            .topBar-item.right{float:right;}
            .topBar-item.align-center{display: flex;align-items: center;justify-content: center}
            .logo-text{font-size: 1.5em;font-weight: bold;text-shadow: 2px 2px 2px grey;}
            .topBar-iconBtn{color:#393939 !important;width:40px;height:50px;
                display:flex;align-items:center;justify-content:center;font-size:1.5em;text-decoration:none !important;}
            .topBar-iconBtn:active{background:#cfcfcf;}
        </style>
    @show
</head>
<body>
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <nav class="topBar">
        <div class="topBar-item align-center">
            <span class="logo-text">动画电影网</span>
        </div>
        <div class="topBar-item right align-center">
            <a href="/" class="topBar-iconBtn"><i class="glyphicon glyphicon-home"></i></a>
        </div>
        <div class="topBar-item right align-center">
            <a href="/search_input" class="topBar-iconBtn"><i class="glyphicon glyphicon-search"></i></a>
        </div>
    </nav>
    @yield("main")
    @section("js_lib")
    @show
    @section("js")
    @show
</body>
</html>
