<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'订单支付']);
function view_content(){
    $m=view::getvar('m');
    ?>
        <h3>
    订单编号：<?=$m['order_id']?><br>
    金额：<font color="red"> <?=$m['sumprice']?></font><br>
    <? if($m['discount']){echo '折扣：'.$m['discount'];}?><br>
        </h3>
    <a href="<?=url('alipay/pay',$m['order_id'])?>" type="button" class="btn btn-danger" target="_blank">支付宝支付</a>
    <a href="<?=url('wxpay/pay',$m['order_id'])?>" type="button" class="btn btn-danger" target="_blank">微信支付</a>
<?php
}
function view_script(){}?>
