
<html>
<head>
    <title>test</title>
</head>
<body>
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <img data-url="/image?file=img/default_headimg.png" class="encode" style="width: 100px;height: 100px" src="">
    <script src="/lib/jquery/dist/jquery.min.js"></script>
    <script>


        $(".encode").each(function(d,e){
            var url=$(e).data("url");
            $.get(url,function(data){
                $(e).attr("src",data);
            });
        });


    </script>
</body>
</html>

