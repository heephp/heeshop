<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">回收站</h4>
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
                <a href="#">广告管理</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?=mtitle('title',$field,$order,'标题')?></th>
                            <th scope="col"><?=mtitle('link',$field,$order,'链接')?></th>
                            <th scope="col"><?=mtitle('hit',$field,$order,'点击')?></th>
                            <th scope="col"><?=mtitle('create_users_id',$field,$order,'创建人')?></th>
                            <th scope="col"><?=mtitle('create_time',$field,$order,'创建时间')?></th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['ad_id']?></td>
                                <td><?=$m['title']?></td>
                                <td><?=$m['link']?></td>
                                <td><?=$m['hit']?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="<?=url('ad_re/'.$m['ad_id'])?>" class="btn btn-warning btn-primary btn-sm">恢复</a>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('ad_del/'.$m['ad_id'])?>">删除</a>

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
