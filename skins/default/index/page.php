<?php
use heephp\view;
view::create();
view::import('../layout/header',['title'=>$m['title'],'kw'=>$m['keyword'],'desc'=>$m['description']]); ?>

    <div class="row cl mt-20" style="padding: 10px">
        <div class="col-xs-12 col-sm-9">
            <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> <a class="maincolor" href="/">首页</a><span class="c-666 en">&gt;</span><a href="#"> <?=$m['title']?></a></nav>

            <h3 style="text-align: center"><?=$m['title']?></h3>

            <div class="content">
                <p><?=$m['body']?></p>

            </div>

            <div class="panel mt-20 panel-default">
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