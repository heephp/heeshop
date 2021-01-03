<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'消息：'.$m['title']]);
function view_content(){
$m=view::getvar('m');
?>

<h3><?=$m['title']?></h3>
<p>
    <?=$m['context']?>
</p>
    <i>时间：<?=$m['create_time']?> 发送人：<?=$m['sender']['username']?> 昵称：<?=$m['sender']['nickname']?> [<a href="<?=url('sendmsg',$m['sender']['username'])?>">回复</a>]</i>

<?php }?>
