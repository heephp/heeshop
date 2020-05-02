<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">模型</h4>
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
                <a href="#">模型管理</a>
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
                            <th scope="col">模型名</th>
                            <th scope="col">关联表</th>
                            <th scope="col">备注</th>
                            <th scope="col">系统模型</th>
                            <th scope="col">创建人</th>
                            <th scope="col">时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['model_id']?></td>
                                <td><?=$m['name']?></td>
                                <td><?=$m['is_sys']?$m['table_name']:($m['model_table']['name'])?></td>
                                <td><?=$m['remark']?></td>
                                <td><?=$m['is_sys']?'是':'否'?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                <?if(empty($m['is_sys'])){?>
                                    <a href="<?=url('edit/',$m['model_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$m['model_id'])?>">删除</a>
                                <?}?>
                                </td>
                            </tr>
                                <?
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
