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
