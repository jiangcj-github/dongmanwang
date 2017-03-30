<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>loading</title>
    <style>
        body{margin: 0;padding: 0;position:absolute;width:100%;height:100%;}
    </style>
</head>
<body>
    <img src="/img/logo.svg" style="width:100%;height:100%;">
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <script>
        $.get("/loading?width="+window.screen.width,function(data){
           location.href=data.url;
        });
    </script>
</body>
</html>
