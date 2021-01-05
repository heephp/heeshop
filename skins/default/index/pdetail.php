<?php
use heephp\view;
view::create();
view::import('../layout/header'); ?>

    <div class="row cl mt-20" style="padding: 10px">
        <div class="col-xs-12 col-sm-9">
            <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> <a class="maincolor" href="/">首页</a><span class="c-666 en">&gt;</span>组件<span class="c-666 en">&gt;</span><span class="c-666">菜单</span></nav>

            <!--产品介绍-->
            <div class="row cl mt-30">
                <div class="col-xs-12 col-sm-6">
                    <div id="sd2">
                        <div class="slider">
                            <div class="bd" style="margin: 0 auto;">
                                <ul>
                                    <li><a href="#" target="_blank"><img src="images/banner-1.jpg" ></a></li>
                                    <li><a href="#" target="_blank"><img src="images/banner-1.jpg" ></a></li>
                                    <li><a href="#" target="_blank"><img src="images/banner-1.jpg" ></a></li>
                                    <li><a href="#" target="_blank"><img src="images/banner-1.jpg" ></a></li>
                                </ul>
                            </div>
                            <ol class="hd cl dots">
                                <li>1</li>
                                <li>2</li>
                                <li>3</li>
                                <li>4</li>
                            </ol>
                        </div>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-6">
                    <h3>产品名称</h3>
                    <h5>产地：地球</h5>
                    <h5>颜色：红色</h5>
                    <h5>规格：20*90CM</h5>
                    <h4 class="c-red">￥：999元</h4>
                    <input class="btn btn-danger radius size-L" type="button" value="立即下单">

                </div>
            </div>
            <hr class=" mt-30">
            <div class="row cl mb-30">

            </div>
            <!--产品介绍-->
            <!--分享代码-->
            <section class="share cl mt-20">
                <div class="bdsharebuttonbox Hui-share">
                    <span class="share-text Hui-iconfont">&#xe715;</span>
                    <a href="#" class="bds_weixin Hui-iconfont" data-cmd="weixin" title="分享到微信">&#xe694;</a>
                    <a href="#" class="bds_qzone Hui-iconfont" data-cmd="qzone" title="分享到QQ空间">&#xe6c8;</a>
                    <a href="#" class="bds_sqq Hui-iconfont" data-cmd="sqq" title="分享到QQ好友">&#xe67b;</a>
                    <a href="#" class="bds_tsina Hui-iconfont" data-cmd="tsina" title="分享到新浪微博">&#xe6da;</a>
                    <a href="#" class="bds_tqq Hui-iconfont" data-cmd="tqq" title="分享到腾讯微博">&#xe6d9;</a>
                    <a href="#" class="bds_douban Hui-iconfont" data-cmd="douban" title="分享到豆瓣网">&#xe67c;</a>
                </div>
                <script type="text/javascript">
                    window._bd_share_config={
                        "common":{
                            "bdSnsKey":{},
                            "bdText":"",
                            "bdMini":"2",
                            "bdMiniList":false,
                            "bdPic":"",
                            "bdStyle":"0",
                        },
                        "share":{},
                        "image":{
                            "viewList":["weixin","qzone","sqq","tsina","tqq","douban"],
                            "viewText":"分享到：","viewSize":"16"},
                        "selectShare":{
                            "bdContainerClass":null,
                            "bdSelectMiniList":["weixin","qzone","sqq","tsina","tqq","douban"]
                        }
                    };
                    with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
                </script>
            </section>
            <!--分享代码-->
        </div>
        <div class="col-xs-12 col-sm-3" style="padding-left: 30px;">
            <div class="panel panel-default">
                <div class="panel-header">面板标题</div>
                <div class="panel-body">面板内容</div>
            </div>
            <div class="panel panel-default mt-20">
                <div class="panel-header">面板标题</div>
                <div class="panel-body">面板内容</div>
            </div>
            <div class="maskWraper mt-20" style="width:275px; height:300px; border:solid 1px #ddd;">
                <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTEwYmJhZjQzYSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1MTBiYmFmNDNhIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ0LjA1NDY4NzUiIHk9Ijc0LjUiPjE0MHgxNDA8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" alt="140x140" class="radius" style="width: 275px; height: 300px;">
                <div class="maskBar text-c">遮罩条</div>
            </div>
        </div>
    </div>
    </div>


<?php view::import('../layout/bottom');
function view_script(){?>
    <script>
        $(function(){
            $("#sd2 .slider").slide({mainCell:".bd ul",titCell:".hd li",trigger:"click",effect:"leftLoop",autoPlay:true,delayTime:700,interTime:7000,pnLoop:false,titOnClassName:"active"})

        });
    </script>
<?php }?>