<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">页面</h4>
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
                <a href="#">页面管理</a>
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
                            <th scope="col"><?=mtitle('title',$field,$order,'标题')?> </th>
                            <th scope="col"><?=mtitle('create_users_id',$field,$order,'创建人')?></th>
                            <th scope="col"><?=mtitle('keyword',$field,$order,'关键词')?></th>
                            <th scope="col"><?=mtitle('create_time',$field,$order,'发布时间')?></th>
                            <th scope="col"><?=mtitle('update_time',$field,$order,'修改时间')?></th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><a href="<?=url('edit/'.$m['pages_id'])?>"><?=sstr($m['title'],20)?></a></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=sstr($m['keyword'],10)?></td>
                                <td><?=$m['create_time']?></td>
                                <td><?=$m['update_time']?></td>
                                <td>
                                    <a href="<?=url('edit/'.$m['pages_id'])?>" class="btn btn-primary btn-sm">编辑</a>
                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$m['pages_id'])?>">删除</a>

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
