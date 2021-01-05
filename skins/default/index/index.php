<?php
use heephp\view;
view::create();
view::import('../layout/header'); ?>

<div class="row cl mt-20">
    <div class="col-xs-12 col-sm-9">
        <div id="sd1" >
            <div class="slider">
                <div class="bd">
                    <ul>
                        <?$adcenters = get_ad('adcenter',3);
                        foreach ($adcenters as $ad){
                        ?>
                        <li><a href="<?=url($ad['link'])?>" target="_blank"><img src="<?=$ad['img']?>"/></a></li>
                        <?}?>
                    </ul>
                </div>
                <ol class="hd cl dots">
                    <li>1</li>
                    <li>2</li>
                    <li>3</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-3">
        <div class="panel panel-default">
            <div class="panel-header">公司介绍</div>
            <div class="panel-body">
                <ol>
                    <?$tlist = get_article('13',7);
                    $i=1;
                    foreach ($tlist as $t){?>
                    <li class="text-overflow"><?=$i?>、<a href="<?=url('detail',$t['article_id'])?>" target="_blank"><?=$t['title']?></a></li>
                    <?
                    $i++;
                    }?>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="row cl mt-20">
    <div class="col-xs-12 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-header">成功案例</div>
            <div class="panel-body">
                <ul>
                    <?$tlist = get_article('2',5);
                    foreach ($tlist as $t){?>
                        <li class="text-overflow"><a href="<?=url('detail',$t['article_id'])?>" target="_blank"><?=$t['title']?></a></li>
                        <?}?>
                </ul>

            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-primary">
            <div class="panel-header">产品展示</div>
            <div class="panel-body">
                <ul>
                    <?$tlist = get_article('7',5);
                    foreach ($tlist as $t){?>
                        <li class="text-overflow"><a href="<?=url('detail',$t['article_id'])?>" target="_blank"><?=$t['title']?></a></li>
                    <?}?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-3">
        <div class="panel panel-primary">
            <div class="panel-header">人才招聘</div>
            <div class="panel-body">
                <ul>
                    <?$tlist = get_article('2',5);
                    foreach ($tlist as $t){?>
                        <li class="text-overflow"><a href="<?=url('detail',$t['article_id'])?>" target="_blank"><?=$t['title']?></a></li>
                    <?}?>
                </ul>
            </div>
        </div>
    </div>
</div>

<img src="__res__/imgs/cgg2.gif" alt="企业大数据网" class="radius mt-30" style="width: 100%; height: 80px;">

<?php view::import('../layout/bottom');
function view_script(){?>
    <script>
        $(function(){
            $("#sd1 .slider").slide({mainCell:".bd ul",titCell:".hd li",trigger:"click",effect:"leftLoop",autoPlay:true,delayTime:700,interTime:7000,pnLoop:false,titOnClassName:"active"})

        });
    </script>
<?php }?>
