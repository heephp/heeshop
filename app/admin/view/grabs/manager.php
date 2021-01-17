<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">栏目</h4>
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
                <a href="#">采集管理</a>
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
                            <th scope="col">名称</th>
                            <th scope="col">网址</th>
                            <th scope="col">描述</th>
                            <th scope="col">相关栏目</th>
                            <th scope="col">创建人</th>
                            <th scope="col">时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['grabs_id']?></td>
                                <td><i class="<?=$m['name']?>"></i></td>
                                <td> <?=$m['url']?></td>
                                <td><?=sstr($m['desc'],10)?></td>
                                <td> <?=$m['category']['name']?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="<?=url('edit',$m['grabs_id'])?>" class="btn btn-primary btn-sm">编辑</a>
                                    <a href="<?=url('copy',$m['grabs_id'])?>" class="btn btn-primary btn-sm">复制</a>
                                    <a href="<?=url('get_list',$m['grabs_id'])?>" class="btn btn-primary btn-sm">采集</a>
                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete',$m['grabs_id'])?>">删除</a>

                                </td>
                            </tr>
                    <?php }?>

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
