<?
use heephp\view;
view::create();
view::import('../layout/header');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">广告</h4>
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
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    广告分组：<a href="<?=url('manager','_')?>">全部分组</a>
                    <?foreach ($adgroup as $g){?>&nbsp;&nbsp;&nbsp;<a href="<?=url('manager',$g['g'])?>"><?=$g['g']?></a> <?}?>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?=mtitle('group',$field,$order,'分组',$group)?></th>
                            <th scope="col"><?=mtitle('title',$field,$order,'标题',$group)?></th>
                            <th scope="col"><?=mtitle('link',$field,$order,'链接',$group)?></th>
                            <th scope="col">图片</th>
                            <th scope="col"><?=mtitle('hit',$field,$order,'点击',$group)?></th>
                            <th scope="col"><?=mtitle('create_users_id',$field,$order,'创建人',$group)?></th>
                            <th scope="col"><?=mtitle('create_time',$field,$order,'创建时间',$group)?></th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['ad_id']?></td>
                                <td><?=$m['group']?></td>
                                <td><?=$m['title']?></td>
                                <td><?=$m['link']?></td>
                                <td><a href="<?=$m['img']?>" target="_blank"> <img src="<?=$m['img']?>" width="50" height="50"></a></td>
                                <td><?=$m['hit']?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="<?=url('edit',$m['ad_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete',$m['ad_id'])?>">删除</a>

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
<?view::import('../layout/bottom');?>
<?function js(){?>


<?}?>