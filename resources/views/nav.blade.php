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
        <link rel="stylesheet" href="/css/nav.css">
        <link rel="stylesheet" href="/lib/ladda/dist/ladda-themeless.min.css">
    @show
</head>
<body>
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <nav class="topBar">
        <div class="topBar-item align-center">
            <img src="img/logo.svg" class="logo">
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
        <script src="/js/nav.js"></script>
        <script src="/lib/ladda/dist/spin.min.js"></script>
        <script src="/lib/ladda/dist/ladda.min.js"></script>
    @show
    @section("js")
        <script>
            $(".topBar").on("dragstart",function(){return false;});
            $(".topBar").on("selectstart",function(){return false;});
        </script>
    @show
</body>
</html>
