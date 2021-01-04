<?php
use heephp\view;
view::create();
view::import('uclayout');
function view_content(){
    ?>
<h1>用户中心</h1>
<h3>欢迎您的登录：<?=request('session.user_name')?></h3>
<h5>这是您第<?=view::getvar('user_loginnum')?>次登录</h5>
<h5>您发布了0条信息，您有0个订单</h5>
<h5>用户组：<?=view::getvar('ugname')?></h5>
<?php }?>