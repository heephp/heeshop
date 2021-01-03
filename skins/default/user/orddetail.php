<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'订单详细']);
function view_content(){
    $m=view::getvar('m');
    ?>
        <h4>订单号：<?=$m['order_id']?>
        <br>
        金额：<?=$m['sumprice']?><br>
            原价：<?=$m['sourceprice']?><br>
            折扣：<?=$m['discount']?><br>
            商品总数：<?=$m['pcount']?><br>
            状态：<?=get_order_state($m['state'])?><br>
            创建时间：<?=$m['create_time']?><br>
            订单详细列表：
        </h4>

    <table class="table table-border table-bordered table-bg table-hover table-demo">
        <thead>
        <tr class="text-c">
            <th>产品</th>
            <th>数量</th>
            <th>单价</th>
            <th>总价</th>
            <th>创建时间</th>
        </tr>
        </thead>
        <tbody class="getData-list" data-currpage="1">
        <? foreach ($m['detail'] as $item){?>
            <tr class="text-c">
                <td class="text-l"><a style="cursor:pointer" class="text-primary" href="<?=url('msg',$item['message_id'])?>" title="查看"><??></a></td>
                <td><?=$item['num']?></td>
                <td><?=$item['price']?></td>
                <td><?=$item['sumprice']?></td>
                <td><?=$item['create_time']?></td>
            </tr>
        <? }?>
        </tbody>
    </table>
    <?php
}
function view_script(){}?>

