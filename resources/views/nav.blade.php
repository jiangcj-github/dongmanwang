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
    @section("css")
        <style>
            #pass2{display: none;margin-bottom:10px;margin-top:-5px;}
        </style>
    @show
</head>
<body>
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <script src="/lib/bootstrap/dist/js/bootstrap.min.js"></script>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="navbar-item">
           <img src="/img/brand.png"/>
        </div>
        <!--nav left-->
        <div class="navbar-item" style="width:20px;"></div>
        <div class="navbar-item align-center">
            <button class="btn btn-primary"><i class="glyphicon glyphicon-cloud-upload"></i>上傳</button>
        </div>
        <div class="navbar-item" style="width:20px;"></div>
        <div class="navbar-item align-center">
            <div class="input-group" style="width: 300px;">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
                </span>
            </div>
        </div>
        <!--nav right-->
        <div class="navbar-item align-center right">
            <div class="drop">
                <button class="btn btn-default drop-header" data-target="login">登錄</button>
                <div id="login" class="drop-body drop-right">
                    <div style="padding: 0 10px;width: 300px">
                        <input type="text" class="form-control" placeholder="Username (3-16 Not Blank)" id="user">
                        <div style="height: 5px"></div>
                        <input type="password" class="form-control" placeholder="Password (6-16 Only a-zA-Z0-9)" id="pass">
                        <div style="height: 10px"></div>
                        <input type="text" class="form-control" placeholder="Confirm Password" id="pass2">
                        <div class="error-msg"><span id="loginError"></span><span class="error-msg-close">&times;</span></div>
                        <button class="btn btn-primary btn-sm ladda-button" data-style="slide-left" id="signinBtn">
                            <span class="ladda-label">確定</span>
                        </button>
                        <button class="btn btn-primary btn-sm ladda-button" data-style="slide-left" id="signupBtn" style="display:none;">
                            <span class="ladda-label">註冊</span>
                        </button>
                        <button class="btn btn-warning btn-sm" id="cancelBtn" style="display:none;">取消</button>
                        <a href="javascript:void(0);" style="margin-left: 10px;" id="signup">註冊帳號</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @yield("content")
    @section("js_lib")
        <script src="/js/nav.js"></script>
        <script src="/lib/ladda/dist/spin.min.js"></script>
        <script src="/lib/ladda/dist/ladda.min.js"></script>
    @show
    @section("js")
        <script>
            var l = Ladda.create(document.querySelector("#signinBtn" ));
            var l2 = Ladda.create(document.querySelector("#signupBtn" ));
            $("#signinBtn").click(function(){
                var user=$("#user").val();
                var pass=$("pass").val();
                if(!assertSignin(user,pass)) return;
                l.start();
                $.post("",{user:user,pass:pass},function(data){
                   if(data.msg){
                       $("#loginError").text(data.msg);
                       $("#loginError").parent().show();
                   }
                   l.stop();
                });
            });
            $("#signupBtn").click(function(){
                var user=$("#user").val();
                var pass=$("#pass").val();
                var pass2=$("#pass2").val();
                if(!assertSignup(user,pass,pass2)) return;
                l.start();
                $.post("",{user:user,pass:pass},function(data){
                    if(data.msg){
                        $("#loginError").text(data.msg);
                        $("#loginError").parent().show();
                    }
                    l.stop();
                });
            });
            $("#cancelBtn").click(function(){
                $("#pass2").hide();
                $("#signupBtn").hide();
                $("#cancelBtn").hide();
                $("#signup").show();
                $("#signinBtn").show();
                $("#loginError").parent().hide();
            });
            $("#signup").click(function(){
                $("#pass2").show();
                $("#signupBtn").show();
                $("#cancelBtn").show();
                $("#signup").hide();
                $("#signinBtn").hide();
                $("#loginError").parent().hide();
            });
            var userTest=/^\S{3,16}$/;
            var passTest=/^[a-zA-Z0-9]{6,16}$/;
            function assertSignin(user,pass){
                if(!userTest.test(user)||!passTest.test(pass)) return false;
                return true;
            }
            function assertSingup(user,pass,pass2){
                if(!userTest.test(user)||!passTest.test(pass)||!passTest.test(pass2)) return false;
                if(pass!==pass2) return false;
                return true;
            }
        </script>
    @show
</body>
</html>
