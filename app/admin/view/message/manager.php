<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">消息</h4>
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
                <a href="#">消息管理</a>
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
                            <th scope="col">发送人</th>
                            <th scope="col">接收人</th>
                            <th scope="col">标题</th>
                            <th scope="col">内容</th>
                            <th scope="col">时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                        <tr>
                            <td><?=$m['message_id']?></td>
                            <td><a href="<?=url('manager/'.$m['users_id'])?>"> <?=$m['sender']['username']?></a></td>
                            <td><a href="<?=url('manager/0/'.$m['receiver_users_id'])?>"?><?=$m['receiver']['username']?></a></td>
                            <td><a href="<?=url('detail/'.$m['message_id'])?>"?> <?=sstr($m['title'],10)?></a></td>
                            <td><?=sstr($m['context'],10)?></td>
                            <td><?=$m['create_time']?></td>
                            <td>
                                <a href="<?=url('edit/'.$m['message_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$m['message_id'])?>">删除</a>

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
