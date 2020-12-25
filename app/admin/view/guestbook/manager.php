<?import('/layout/header.php');?>
    <div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">留言</h4>
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
                <a href="#">留言管理</a>
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
                            <th scope="col">昵称</th>
                            <th scope="col">联系人</th>
                            <th scope="col">手机</th>
                            <th scope="col">微信</th>
                            <th scope="col">QQ</th>
                            <th scope="col">内容</th>
                            <th scope="col">评论人</th>
                            <th scope="col">发表时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td></td>
                                <td><?=$m['nickname']?></td>
                                <td><?=$m['contact']?></td>
                                <td><?=$m['mobile']?></td>
                                <td><?=$m['wx']?></td>
                                <td><?=$m['qq']?></td>
                                <td title="<?=$m['context']?>"> <?=sstr($m['context'],10)?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="<?=url('edit',$m['guestbook_id'])?>" class="btn btn-primary btn-sm">详细</a>
                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete',$m['guestbook_id'])?>">删除</a>

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

<?import('/layout/bottom.php');?>
<?function js(){?>


<?}?>