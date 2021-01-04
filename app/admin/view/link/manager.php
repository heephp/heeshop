<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">链接</h4>
        <ul class="breadcrumbs">
            <li class="nav-home">
                <a href="#">
                    <i class="flaticon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="<?=url('/'.APP.'/link_group/manager/'.$group['link_group_id'])?>"><?=$group['title']?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">链接管理</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php',['pid'=>0,'link_group_id'=>$group['link_group_id']])?>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">图标</th>
                            <th scope="col">标题</th>
                            <th scope="col">链接</th>
                            <th scope="col">备注</th>
                            <th scope="col">排序</th>
                            <th scope="col">创建人</th>
                            <th scope="col">时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['link_id']?></td>
                                <td><?=$m['icon']?></td>
                                <td><?=sstr($m['title'],10)?></td>
                                <td><?=sstr($m['url'],10)?></td>
                                <td><?=sstr($m['remark'],10)?></td>
                                <td><?=$m['ord']?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="<?=url('add',[$m['link_id'],$m['link_group_id']])?>" class="btn btn-primary btn-sm">添加子菜单</a>

                                    <a href="<?=url('edit',[$m['link_id']])?>" class="btn btn-primary btn-sm">编辑</a>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete',$m['link_id'])?>">删除</a>

                                </td>
                            </tr>
                            <?
                            if(isset($m['child']))
                                foreach($m['child'] as $c){?>
                                    <tr>
                                        <td><?=$c['link_id']?></td>
                                        <td><?=$c['icon']?></td>
                                        <td>-- <?=sstr($c['title'],10)?></td>
                                        <td><?=sstr($c['url'],10)?></td>
                                        <td><?=sstr($c['remark'],10)?></td>
                                        <td><?=$c['ord']?></td>
                                        <td><?=$c['create_user']['username']?></td>
                                        <td><?=$c['create_time']?></td>
                                        <td>
                                            <a href="<?=url('edit',$c['link_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                            <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete',$c['link_id'])?>">删除</a>

                                        </td>
                                    </tr>
                                <?}
                        }?>

                        </tbody>
                    </table>
                    <?=$pager?>
                </div>
            </div>
        </div>
    </div>

</div>
<?import('/layout/bottom.php');?>
<?function js(){?>


<?}?>
