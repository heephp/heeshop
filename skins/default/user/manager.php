<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'信息管理']);
function view_content(){

    ?>

    <table class="table table-border table-bordered table-bg table-hover table-list">
        <thead>
        <tr class="text-c">
            <th width="25"><input class="checkbox checkbox-all" type="checkbox" name="" value="all"></th>
            <th>标题</th>
            <th width="80">分类</th>
            <th width="120">更新时间</th>
            <th width="75">浏览次数</th>
            <th width="75">操作</th>
        </tr>
        </thead>
        <? foreach (view::getvar('list') as $item){?>
        <tbody class="getData-list" data-currpage="1">
        <tr class="text-c">
            <td><input class="checkbox" type="checkbox" value="<?=$item['article_id']?>" name=""></td>
            <td class="text-l"><a href="<?=url('editart',$item['article_id'])?>" style="cursor:pointer" class="text-primary" title="查看"><?=$item['title']?></a></td>
            <td><?=$item['category']['name']?></td>
            <td><?=$item['create_time']?></td>
            <td><?=$item['hit']?></td>
            <td>[<a href="<?=url('editart',$item['article_id'])?>">编辑</a>] [<a href="<?=url('delart',$item['article_id'])?>" onclick="return confirm('确定要删除该记录吗？')">删除</a>]</td>
        </tr>
        <? }?>
        </tbody>
    </table>
    <?=view::getvar('pager')?>
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
