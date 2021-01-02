<?php
use heephp\view;
view::create();
view::import('../layout/header',['title'=>$cate['name'],'kw'=>$cate['keyword'],'desc'=>$cate['remark']]); ?>


<div class="row cl mt-30" style="padding: 10px">
    <div class="col-xs-12 col-sm-9">
        <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> <a class="maincolor" href="/">首页</a><?if(isset($cate['parent'])){?><span class="c-666 en">&gt;</span><?=$cate['parent']['name']?><?}?><span class="c-666 en">&gt;</span><a href="<?=url('_list',$cate['category_id'])?>"> <?=$cate['name']?></a></nav>
        <ul class="mt-20 pl-30" style="list-style: circle">
            <?foreach ($list as $item){?>
            <li style="line-height: 36px"><a href="<?=url('detail',$item['article_id'])?>" class="lh-28 f-16"><?=$item['title']?></a><span class="c-999 f-12"><?=$item['create_time']?></span></li>
            <?}?>
        </ul>
        <?=$pager?>
    </div>
    <div class="col-xs-12 col-sm-3" style="padding-left: 30px;">
        <?view::import('../layout/side')?>
    </div>
</div>
</div>



<?php view::import('../layout/bottom'); ?>
