<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'收件箱']);
function view_content(){
?>

<table class="table table-border table-bordered table-bg table-hover table-demo">
    <thead>
    <tr class="text-c">
        <th width="25"><input class="checkbox checkbox-all" type="checkbox" name="" value="all"></th>
        <th>标题</th>
        <th width="80">发送人</th>
        <th width="80">已读</th>
        <th width="120">发送时间</th>
    </tr>
    </thead>
    <tbody class="getData-list" data-currpage="1">
    <? foreach (view::getvar('list') as $item){?>
    <tr class="text-c">
        <td><input class="checkbox" type="checkbox" value="10001" name=""></td>
        <td class="text-l"><a style="cursor:pointer" class="text-primary" href="<?=url('msg',$item['message_id'])?>" title="查看"><?=$item['title']?></a></td>
        <td><?=$item['sender']['username']?></td>
        <td><?=$item['isread']?'已读':'未读'?></td>
        <td><?=$item['create_time']?></td>
    </tr>
    <? }?>
    </tbody>
</table>

<?php }?>