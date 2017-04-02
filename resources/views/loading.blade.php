<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>loading</title>
</head>
<body>
    <script>
        function isCookieEnabled(){
            if (navigator.cookieEnabled) return true;
            // set and read cookie
            document.cookie = "cookietest=1";
            var ret = document.cookie.indexOf("cookietest=") != -1;
            // delete cookie
            document.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";
            return ret;
        }
        location.href="/confirmDevice?deviceWidth="+window.screen.width+"&cookieEnable="+isCookieEnabled();
    </script>
</body>
</html>
