<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">用户</h4>
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
                <a href="#">用户管理</a>
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
                            <th scope="col">头像</th>
                            <th scope="col">用户名</th>
                            <th scope="col">用户组</th>
                            <th scope="col">昵称</th>
                            <th scope="col">性别</th>
                            <th scope="col">手机</th>
                            <th scope="col">微信</th>
                            <th scope="col">时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                        <tr>
                            <td><?=$m['users_id']?></td>
                            <td><div class="avatar avatar-sm"><img src="<?=$m['header']?>" class="avatar-img rounded-circle"></div></td>
                            <td><?=sstr($m['username'],10)?></td>
                            <td><?=$m['users_group']['name']?></td>
                            <td><?=$m['nickname']?></td>
                            <td><?=$m['sex']?></td>
                            <td><?=$m['mobile']?></td>
                            <td><?=$m['wechat']?></td>
                            <td><?=$m['create_time']?></td>
                            <td>
                                <a href="<?=url('edit/'.$m['users_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$m['users_id'])?>">删除</a>

                            </td>
                        </tr>
                        <?}?>
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
