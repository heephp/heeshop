<div class="panel panel-default">
    <div class="panel-header">行业新闻</div>
    <div class="panel-body">
        <ul>
            <?$tlist = get_article('7',5);
            foreach ($tlist as $t){?>
                <li class="text-overflow"><a href="<?=url('detail',$t['article_id'])?>" target="_blank"><?=$t['title']?></a></li>
            <?}?>
        </ul>
    </div>
</div>
<div class="panel mt-20 panel-default">
    <div class="panel-header">展会资讯</div>
    <div class="panel-body">
        <ul>
            <?$tlist = get_article('2',5);
            foreach ($tlist as $t){?>
                <li class="text-overflow"><a href="<?=url('detail',$t['article_id'])?>" target="_blank"><?=$t['title']?></a></li>
            <?}?>
        </ul>
    </div>
</div>
<div class="maskWraper mt-20" style="width:275px; height:300px; border:solid 1px #ddd;">
    <img src="__res__/imgs/ad1.gif" alt="140x140" class="radius" style="width: 275px; height: 300px;">
    <div class="maskBar text-c">遮罩条</div>
</div>