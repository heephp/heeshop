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
                <a href="#">栏目管理</a>
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
                            <th scope="col">栏目名称</th>
                            <th scope="col">关键词</th>
                            <th scope="col">排序</th>
                            <th scope="col">备注</th>
                            <th scope="col">创建人</th>
                            <th scope="col">时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['category_id']?></td>
                                <td> <i class="<?=$m['icon']?>"></i><?=$m['name']?></td>
                                <td><?=sstr($m['keyword'],10)?></td>
                                <td> <?=$m['ord']?></td>
                                <td><?=sstr($m['remark'],10)?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>

                                </td>
                            </tr>
                            <?
                            if(isset($m['child']))
                                foreach($m['child'] as $c){?>
                                    <tr>
                                        <td><?=$c['category_id']?></td>
                                        <td>      + <i class="<?=$c['icon']?>"></i> <a href="<?=url('/'.APP.'/info/manager/'.$c['category_id'])?>"> <?=$c['name']?></a></td>
                                        <td><?=sstr($c['keyword'],10)?></td>
                                        <td> <?=$c['ord']?></td>
                                        <td><?=sstr($c['remark'],10)?></td>
                                        <td><?=$c['create_user']['username']?></td>
                                        <td><?=$c['create_time']?></td>
                                        <td>
                                            <a href="<?=url('/'.APP.'/info/manager/'.$c['category_id'])?>" class="btn btn-primary btn-sm">信息管理</a>


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
