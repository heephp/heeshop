<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">信息</h4>
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
            <li class="separator">
                <a href="#"><?=$category_name?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">信息管理</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('toolsbar.php',['category_id'=>$categoryid])?>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"><?=mtitle('recommend',$field,$order,'标题',$categoryid)?> </th>
                            <th scope="col"><?=mtitle('create_users_id',$field,$order,'创建人',$categoryid)?></th>
                            <th scope="col">关键词</th>
                            <th scope="col"><?=mtitle('create_time',$field,$order,'发布时间',$categoryid)?></th>
                            <th scope="col"><?=mtitle('update_time',$field,$order,'修改时间',$categoryid)?></th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td>  <small><font color="#ff0000"> <?=empty($m['recommend'])?'':'[推荐]'?></font></small> <a href="<?=url('edit',$m['article_id'])?>"><?=sstr($m['title'],20)?></a></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=sstr($m['keyword'],10)?></td>
                                <td><?=$m['create_time']?></td>
                                <td><?=$m['update_time']?></td>
                                <td>
                                    [<a href="<?=url('recommend',$m['article_id'])?>"><?=empty($m['recommend'])?'推荐':'取消推荐'?></a>]
                                    [<a href="<?=url('edit',$m['article_id'])?>">编辑</a>]
                                    [<a href="#" url="<?=url('delete',$m['article_id'])?>" class="delete">删除</a>]

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
