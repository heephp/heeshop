<?
$cpath = '/'.CONTROLLER.'/'.METHOD;
$musers = (in_array(CONTROLLER,['users','users_group','message'])&&$cpath！='/users_group/sys_resource')?'show':'';
$mrole = (in_array(CONTROLLER,['sys_resources','menus'])||$cpath=='/users_group/sys_resource')?'show':'';
$mtrash = CONTROLLER=='trash'?'show':'';
?>

<div class="sidebar sidebar-style-2">
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?=(empty(request('session.admin_user_header'))?'/assets/img/profile.jpg':request('session.admin_user_header'))?>" alt="头像" class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
									<span>
										<?=request('session.admin_user_name')?>
										<span class="user-level"><?=request('session.admin_user_group_name')?></span>
										<span class="caret"></span>
									</span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="<?=url('/'.APP.'/users/edit/'.request('session.admin_user_id'))?>">
                                    <span class="link-collapse">个人资料</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-item active">
                    <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>控制台</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="dashboard">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?=url('/'.APP.'/index/index')?>">
                                    <span class="sub-item">控制台</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/index/setting')?>">
                                    <span class="sub-item">系统设置</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/index/cache_clear')?>">
                                    <span class="sub-item">清理缓存</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-section">
								<span class="sidebar-mini-icon">
									<i class="fa fa-ellipsis-h"></i>
								</span>
                    <h4 class="text-section">信息管理</h4>
                </li>

                <? foreach ($menus as $mitem) {?>
                    <li class="nav-item">
                        <a data-toggle="collapse" href="#user_<?=$mitem['menus_id']?>">
                            <i class="<?=$mitem['icon']?>"></i>
                            <p><?=$mitem['title']?></p>
                            <span class="caret"></span>
                        </a>
                        <?
                            $mushow =in_array($cpath,array_column($mitem['child'],'link'))?'show':'';
                        ?>
                        <div class="collapse <?=$mushow?>" id="user_<?=$mitem['menus_id']?>">
                            <ul class="nav nav-collapse">
                                <? foreach ($mitem['child'] as $mc) {?>

                                <li>
                                    <a href="<?=url('/'.APP.'/'.$mc['link'])?>">
                                        <span class="sub-item"><?=$mc['title']?></span>
                                    </a>
                                </li>

                                <?}?>
                            </ul>
                        </div>
                    </li>
                <?}?>


                <li class="nav-section">
								<span class="sidebar-mini-icon">
									<i class="fa fa-ellipsis-h"></i>
								</span>
                    <h4 class="text-section">系统管理</h4>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#sys">
                        <i class="fas fa-users"></i>
                        <p>用户管理</p>
                        <span class="caret"></span>
                    </a>

                    <div class="collapse <?=$musers?>" id="sys">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?=url('/'.APP.'/users/manager')?>">
                                    <span class="sub-item">用户管理</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/users_group/manager')?>">
                                    <span class="sub-item">用户组管理</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/message/manager')?>">
                                    <span class="sub-item">消息管理</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item submenu">
                    <a data-toggle="collapse" href="#roleres">
                        <i class="fas fa-user-lock"></i>
                        <p>权限管理</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?=$mrole?>" id="roleres">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?=url('/'.APP.'/sys_resources/manager')?>">
                                    <span class="sub-item">资源管理</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/users_group/sys_resource')?>">
                                    <span class="sub-item">用户组权限</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/menus/manager')?>"">
                                    <span class="sub-item">菜单管理</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#trash">
                        <i class="fas fa-trash-alt"></i>
                        <p>回收站</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?=$mtrash?>" id="trash">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?=url('/'.APP.'/trash/users')?>">
                                    <span class="sub-item active">用户</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/trash/users_group')?>">
                                    <span class="sub-item">用户组</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/trash/message')?>">
                                    <span class="sub-item">消息</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/trash/menus')?>">
                                    <span class="sub-item">菜单</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


            </ul>
        </div>
    </div>
</div>
