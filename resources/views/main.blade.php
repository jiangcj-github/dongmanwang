@extends("nav")
@section("title","动画电影网")
@section("css_lib")
    @parent
    <link rel="stylesheet" href="/css/main.css">
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
