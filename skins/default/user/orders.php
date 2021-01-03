<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'订单管理']);
function view_content(){

    ?>

    <table class="table table-border table-bordered table-bg table-hover table-list">
        <thead>
        <tr class="text-c">
            <th width="25"><input class="checkbox checkbox-all" type="checkbox" name="" value="all"></th>
            <th>订单号</th>
            <th width="100">产品数量</th>
            <th width="80">总价</th>
            <th width="80">状态</th>
            <th width="80">支付方式</th>
            <th width="120">下单时间</th>
            <th width="120">操作</th>
        </tr>
        </thead>
        <? foreach (view::getvar('list') as $item){?>
        <tbody class="getData-list" data-currpage="1">
        <tr class="text-c">
            <td><input class="checkbox" type="checkbox" value="<?=$item['article_id']?>" name=""></td>
            <td class="text-l"><a href="<?=url('orddetail',$item['order_id'])?>" style="cursor:pointer" class="text-primary" title="查看"><?=$item['order_id']?></a></td>
            <td><?=$item['pcount']?></td>
            <td><?=$item['sumprice']?><?=!empty($item['discount'])?'(折扣：'.$item['discount'].')':''?><d><?=$item['sourceprice']?></d></td>
            <td><?=get_order_state($item['state'])?></td>
            <td><?=$item['paytype']?></td>
            <td><?=$item['create_time']?></td>
            <td>
                    <?if($item['state']>0&&(time()-$item['paytime'])<7*24*60*60){
                        //7天内可退款?>
                        [<a href="" onclick="confirm('确认要退款吗？')"> 退款</a>]
                    <? }
                    if($item['state']==3){?>
                        [<a href=""> 评价</a>]
                    <?}
                    if($item['state']==2){?>
                        [<a href=""> 确认收货</a>]
                    <? }
                    if($item['state']==0){?>
                        [<a href="<?=url('pay',$item['order_id'])?>"> 支付</a>]
                    <? }
                    if($item['state']==1){?>
                        [<a href=""> 查看物流</a>]
                    <? }
                    if($item['state']==-1||$item['state']==-2){?>
                        [<a href=""> 退款进度</a>]
                    <? }
                    if($item['state']==-3){?>
                        [已退款]
                    <? } ?>
                [<a href="<?=url('delorder',$item['order_id'])?>"> 删除</a>]</td>
        </tr>
        <? }?>
        </tbody>
    </table>
    <?=$pager?>
<?php }
function view_script(){?>
    <script src="__res__js/HeecheckAll.js"></script>
    <script>
        $(".table-list").HeecheckAll(
            {
                checkboxAll: 'thead input[type="checkbox"]',  // 表头全选的checkbox
                checkbox: 'tbody input[type="checkbox"]' // 列表开头的checkbox
            },
            function(checkedInfo) {
                console.log(checkedInfo); // checkedInfo 就是选择后返回的参数，请根据自己的业务接口进行二次加工。
            }
        )
    </script>
<?php }?>
