<?php
use heephp\view;
view::create();
view::import('../layout/header',['title'=>$m['title'],'kw'=>$m['keyword'],'desc'=>$m['description']]); ?>
    <h3>
        订单编号：<?=$m['order_id']?><br>
        支付项目：<?=$m['detail'][0]['product']['title']??$m['detail'][0]['product']['name']?><br>
        金额：<font color="red"> <?=$m['sumprice']?></font><br>
        <? if($m['discount']<1){echo '折扣：'.$m['discount'];}?><br>
    </h3>
    <a href="<?=url('alipay/pay',$m['order_id'])?>" type="button" class="btn btn-danger" target="_blank">支付宝支付</a>
    <a href="<?=url('wxpay/pay',$m['order_id'])?>" type="button" class="btn btn-success" target="_blank">微信支付</a>

<?php
view::import('../layout/bottom'); ?>