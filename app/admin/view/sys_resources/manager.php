<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">资源</h4>
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
                <a href="#">管理</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">资源管理</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">标题</th>
                            <th scope="col">路径</th>
                            <th scope="col">备注</th>
                            <th scope="col">创建人</th>
                            <th scope="col">时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['sys_resources_id']?></td>
                                <td><?=$m['title']?></td>
                                <td><?=$m['path']?></td>
                                <td><?=sstr($m['remark'],10)?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="<?=url('edit/'.$m['sys_resources_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$m['sys_resources_id'])?>">删除</a>

                                </td>
                            </tr>
                            <?
                            if(isset($m['child']))
                            foreach($m['child'] as $c){?>
                                <tr>
                                    <td><?=$c['sys_resources_id']?></td>
                                    <td> ———— <?=$c['title']?></td>
                                    <td><?=$c['path']?></td>
                                    <td><?=sstr($c['remark'],10)?></td>
                                    <td><?=$c['create_user']['username']?></td>
                                    <td><?=$c['create_time']?></td>
                                    <td>
                                        <a href="<?=url('edit/'.$c['sys_resources_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                        <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$c['sys_resources_id'])?>">删除</a>

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
