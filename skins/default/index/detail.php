<?php
use heephp\view;
view::create();
view::import('../layout/header',['title'=>$m['title'].' -- '.$cate['name'],'kw'=>$m['keyword'],'desc'=>$m['remark']]); ?>

    <div class="row cl mt-30" style="padding: 10px">
        <div class="col-xs-12 col-sm-9">
            <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> <a class="maincolor" href="/">首页</a><?if(isset($cate['parent'])){?><span class="c-666 en">&gt;</span><?=$cate['parent']['name']?><?}?><span class="c-666 en">&gt;</span><a href="<?=url('_list',$cate['category_id'])?>"> <?=$cate['name']?></a></nav>

            <h3 style="text-align: center"><?=$m['title']?><br><small> 来源：<?=$m['author']?>互联网  时间：<?=date('Y-m-d H:i',$m['create_time'])?></small></h3>

            <div class="content">
                <p><?=$m['context']?></p>

            </div>

            <!--分享代码-->
            <section class="share cl mt-30">
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
            <div class="panel mt-30 panel-default">
                <div class="panel-header">最新资讯</div>
                <div class="panel-body">
                    <ul>
                        <?$tlist = get_article('2,3,13,14,7',5,0);
                        foreach ($tlist as $t){?>
                            <li class="text-overflow"><a href="<?=url('detail',$t['article_id'])?>" target="_blank"><?=$t['title']?></a></li>
                        <?}?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-3" style="padding-left: 30px;">
            <?view::import('../layout/side')?>
        </div>
    </div>
    </div>

<?php view::import('../layout/bottom'); ?>