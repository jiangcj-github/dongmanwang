@extends("nav")
@section("title","动画电影网")
@section("css")
    @parent
    <style>
        .main{display:flex;justify-content:center}
        .page{width:80%;padding-top:20px;}

        .leftBar{width:200px;float:left;}
        .lb-section{background: white;border:1px solid #cfcfcf;margin-bottom:20px;border-bottom:none;}
        .lb-sec-head{line-height:2;padding:0 15px;border-bottom:1px solid #cfcfcf;font-weight:bold;}
        .lb-sec-item{height:70px;cursor:pointer;border-bottom:1px solid #cfcfcf}
        .lb-sec-item:hover{opacity:0.8;}
        .lb-sec-item>img{width:100px;height:70px;float:left;}
        .lb-sec-item-text{padding-left:110px;height:70px;line-height:70px;}

        .content{margin-left:220px;}
        .section{background: white;border:1px solid #cfcfcf;margin-bottom:20px;}
        .section-header{font-size:1.2em;line-height:2.4;padding:0 15px;border-bottom:1px solid #cfcfcf;font-weight:bold;}
        .section-header>a{float:right;margin-left:10px;}
        .srow{display:flex;margin:20px 0;padding:0 10px;}
        .scell{width:20%;padding:0 10px;}
        .scell-img{width:100%;height:0px;padding-bottom:133%;background-size:100% 100% !important;border:1px solid #cfcfcf;}
        .scell-img:hover{opacity:0.8;cursor:pointer;}
        .scell-info{text-align:center;word-wrap:break-word;height:20px;line-height:20px;overflow:hidden;}
    </style>
@append
@section("main")
    <div class="main">
        <div class="page">
            <div class="leftBar">
                <div class="lb-section">
                    <div class="lb-sec-head">
                        地区分类
                    </div>
                    <div class="lb-sec-item">
                        <img src="img/m_guochan.jpg">
                        <div class="lb-sec-item-text">国产动漫</div>
                    </div>
                    <div class="lb-sec-item">
                        <img src="img/m_riben.jpg">
                        <div class="lb-sec-item-text">日本动漫</div>
                    </div>
                    <div class="lb-sec-item">
                        <img src="img/m_oumei.jpg">
                        <div class="lb-sec-item-text">欧美动漫</div>
                    </div>
                    <div class="lb-sec-item">
                        <img src="img/m_qita.jpg">
                        <div class="lb-sec-item-text">其他地区</div>
                    </div>
                </div>
                <div class="lb-section">
                    <div class="lb-sec-head">
                        经典影集
                    </div>
                    <div class="lb-sec-item">
                        <img src="img/m_gongqijun.jpg">
                        <div class="lb-sec-item-text">宫崎骏电影</div>
                    </div>
                    <div class="lb-sec-item">
                        <img src="img/m_xinhaicheng.jpg">
                        <div class="lb-sec-item-text">新海城电影</div>
                    </div>
                </div>
            </div>
            <div class="content">
                @section("content")
                    <div class="section">
                        <div class="section-header">
                            最新上映
                            <a href="#"><i class="glyphicon glyphicon-plus"></i></a>
                            <a href="#"><i class="glyphicon glyphicon-refresh"></i></a>
                        </div>
                        <div class="srow">
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">火影忍者剧场版8-忍者之路</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                        </div>
                        <div class="srow">
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                        </div>
                        <div class="srow">
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                            <div class="scell">
                                <div class="scell-img" style="background: url(/img/1.jpg);"></div>
                                <div class="scell-info">萤火之森</div>
                            </div>
                        </div>
                    </div>
                @show
            </div>
        </div>
    </div>
@append
@section("js")
    @parent
    <script>
        $(".scell-img").click(function(){
            open("/play","_blank");
        });
    </script>
@append
