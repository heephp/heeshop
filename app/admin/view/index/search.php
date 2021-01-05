<?php
use heephp\view;
view::create();
view::import('../layout/header');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">搜索结果</h4>
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
                <a href="#">关键词：<?=$keyword?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">搜索结果</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <?if($article_list){?>
                        <h3><?=$article_title?></h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">标题 </th>
                                <th scope="col">创建人</th>
                                <th scope="col">关键词</th>
                                <th scope="col">发布时间</th>
                                <th scope="col">修改时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?foreach($article_list as $m){?>
                                <tr>
                                    <td>  <small><font color="#ff0000"> <?=empty($m['recommend'])?'':'[推荐]'?></font></small> <a href="<?=url('edit',$m['article_id'])?>"><?=sstr($m['title'],20)?></a></td>
                                    <td><?=$m['create_user']['username']?></td>
                                    <td><?=sstr($m['keyword'],10)?></td>
                                    <td><?=$m['create_time']?></td>
                                    <td><?=$m['update_time']?></td>
                                    <td>
                                        [<a href="<?=url('article/edit',$m['article_id'])?>">编辑</a>]
                                        [<a href="#" url="<?=url('article/delete',$m['article_id'])?>" class="delete">删除</a>]

                                    </td>
                                </tr>
                            <?}?>

                            </tbody>
                        </table>
                        <?=$article_pager?>
                    <?}?>

                    <?if($category_list){?>
                        <h3><?=$category_title?></h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">图标</th>
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
                            <?foreach($category_list as $m){?>
                                <tr>
                                    <td><?=$m['category_id']?></td>
                                    <td><i class="<?=$m['icon']?>"></i></td>
                                    <td> + <?=$m['name']?></td>
                                    <td><?=sstr($m['keyword'],10)?></td>
                                    <td> <?=$m['ord']?></td>
                                    <td><?=sstr($m['remark'],10)?></td>
                                    <td><?=$m['create_user']['username']?></td>
                                    <td><?=$m['create_time']?></td>
                                    <td>
                                        <a href="<?=url('category/edit',$m['category_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                        <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('category/delete',$m['category_id'])?>">删除</a>

                                    </td>
                                </tr>
                                <?
                                if(isset($m['child']))
                                    foreach($m['child'] as $c){?>
                                        <tr>
                                            <td><?=$c['category_id']?></td>
                                            <td><i class="<?=$c['icon']?>"></i></td>
                                            <td style="padding-left:30px !important;"> ▷ <i class="<?=$c['icon']?>"></i><?=$c['name']?></td>
                                            <td><?=sstr($c['keyword'],10)?></td>
                                            <td> <?=$c['ord']?></td>
                                            <td><?=sstr($c['remark'],10)?></td>
                                            <td><?=$c['create_user']['username']?></td>
                                            <td><?=$c['create_time']?></td>
                                            <td>
                                                <a href="<?=url('category/edit',$c['category_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                                <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('category/delete',$c['category_id'])?>">删除</a>

                                            </td>
                                        </tr>
                                    <?}
                            }?>

                            </tbody>
                        </table>
                        <?=$category_pager?>
                    <?}?>

                    <?if($users_list){?>
                        <h3><?=$users_title?></h3>
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
                        <?foreach($users_list as $m){?>
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
                                    <a href="<?=url('users/edit',$m['users_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('users/delete',$m['users_id'])?>">删除</a>

                                </td>
                            </tr>
                        <?}?>
                        </tbody>
                    </table>
                    <?=$users_pager?>
                    <?}?>

                    <?if($users_group_list){?>
                        <h3><?=$users_group_title?></h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">用户组</th>
                                <th scope="col">备注</th>
                                <th scope="col">创建人</th>
                                <th scope="col">时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?foreach($users_group_list as $m){?>
                                <tr>
                                    <td><?=$m['users_group_id']?></td>
                                    <td><?=$m['name']?></td>
                                    <td><?=sstr($m['remark'],10)?></td>
                                    <td><?=$m['create_user']['username']?></td>
                                    <td><?=$m['create_time']?></td>
                                    <td>
                                        <a href="<?=url('users_group/edit',$m['users_group_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                        <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('users_group/delete',$m['users_group_id'])?>">删除</a>
                                    </td>
                                </tr>
                            <?}?>
                            </tbody>
                        </table>


                        <?=$users_group_pager?>
                    <?}?>

                    <?if($menus_list){?>
                        <h3><?=$menus_title?></h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">标题</th>
                                <th scope="col">链接</th>
                                <th scope="col">备注</th>
                                <th scope="col">创建人</th>
                                <th scope="col">时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?foreach($menus_list as $m){?>
                                <tr>
                                    <td><?=$m['menus_id']?></td>
                                    <td><i class="<?=$m['icon']?>"></i> <?=$m['title']?></td>
                                    <td><?=$m['link']?></td>
                                    <td><?=sstr($m['remark'],10)?></td>
                                    <td><?=$m['create_user']['username']?></td>
                                    <td><?=$m['create_time']?></td>
                                    <td>
                                        <a href="<?=url('menus/edit',$m['menus_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                        <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('menus/delete',$m['menus_id'])?>">删除</a>

                                    </td>
                                </tr>
                                <?
                                if(isset($m['child']))
                                    foreach($m['child'] as $c){?>
                                        <tr>
                                            <td><?=$c['menus_id']?></td>
                                            <td> —— <i class="<?=$c['icon']?>"></i> <?=$c['title']?></td>
                                            <td><?=$c['link']?></td>
                                            <td><?=sstr($c['remark'],10)?></td>
                                            <td><?=$c['create_user']['username']?></td>
                                            <td><?=$c['create_time']?></td>
                                            <td>
                                                <a href="<?=url('menus/edit',$c['menus_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                                <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('menus/delete',$c['menus_id'])?>">删除</a>

                                            </td>
                                        </tr>
                                    <?}
                            }?>

                            </tbody>
                        </table>
                        <?=$menus_pager?>
                    <?}?>

                    <?if($message_list){?>
                        <h3><?=$message_title?></h3>
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
                            <?foreach($message_list as $m){?>
                                <tr>
                                    <td><?=$m['message_id']?></td>
                                    <td><a href="<?=url('message/manager',$m['users_id'])?>"> <?=$m['sender']['username']?></a></td>
                                    <td><a href="<?=url('message/manager',[0,$m['receiver_users_id']])?>"?><?=$m['receiver']['username']?></a></td>
                                    <td><a href="<?=url('message/detail',$m['message_id'])?>"?> <?=sstr($m['title'],10)?></a></td>
                                    <td><?=sstr($m['context'],10)?></td>
                                    <td><?=$m['create_time']?></td>
                                    <td>
                                        <a href="<?=url('message/edit',$m['message_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                        <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('message/delete',$m['message_id'])?>">删除</a>

                                    </td>
                                </tr>
                            <?}?>
                            </tbody>
                        </table>
                        <?=$message_pager?>
                    <?}?>

                    <?if($sys_resources_list){?>
                        <h3><?=$sys_resources_title?></h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">标题</th>
                                <th scope="col">路径</th>
                                <th scope="col">备注</th>
                                <th scope="col">创建人</th>
                                <th scope="col">时间</th>
                                <th scope="col">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?foreach($sys_resources_list as $m){?>
                                <tr>
                                    <td><?=$m['sys_resources_id']?></td>
                                    <td><?=$m['title']?></td>
                                    <td><?=$m['path']?></td>
                                    <td><?=sstr($m['remark'],10)?></td>
                                    <td><?=$m['create_user']['username']?></td>
                                    <td><?=$m['create_time']?></td>
                                    <td>
                                        <a href="<?=url('sys_resources/edit',$m['sys_resources_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                        <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('sys_resources/delete',$m['sys_resources_id'])?>">删除</a>

                                    </td>
                                </tr>
                                <?
                                if(isset($m['child']))
                                    foreach($m['child'] as $c){?>
                                        <tr>
                                            <td><?=$c['sys_resources_id']?></td>
                                            <td> ———— <?=$c['title']?></td>
                                            <td><?=$c['path']?></td>
                                            <td><?=sstr($c['remark'],10)?></td>
                                            <td><?=$c['create_user']['username']?></td>
                                            <td><?=$c['create_time']?></td>
                                            <td>
                                                <a href="<?=url('sys_resources/edit',$c['sys_resources_id'])?>" class="btn btn-primary btn-sm">编辑</a>

                                                <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('sys_resources/delete',$c['sys_resources_id'])?>">删除</a>

                                            </td>
                                        </tr>
                                    <?}
                            }?>
                            </tbody>
                        </table>
                        <?=$sys_resources_pager?>
                    <?}?>
                </div>
            </div>
        </div>
    </div>

</div>
<?view::import('../layout/bottom');?>
<?function js(){?>


<?}?>
