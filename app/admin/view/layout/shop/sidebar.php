<?
//$cpath = '/'.CONTROLLER.'/'.METHOD;
$mshop = 'show';//(in_array(CONTROLLER,['shop_product','shop_category','shop_sku']))?'show':'';
$mcart = 'show';//(in_array(CONTROLLER,['sys_resources','menus']))?'show':'';
$mtrash = 'show';//CONTROLLER=='trash'?'show':'';
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
                    <h4 class="text-section">商城管理</h4>
                </li>

                <li class="nav-item submenu">
                    <a data-toggle="collapse" href="#shop">
                        <i class="fas fa-shopping-cart"></i>
                        <p>商城管理</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?=$mshop?>" id="shop">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?=url('/'.APP.'/shop_product/manager')?>"">
                                <span class="sub-item">商品管理</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?=url('/'.APP.'/shop_category/manager')?>">
                                    <span class="sub-item">商品分类管理</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?=url('/'.APP.'/shop_sku/manager')?>">
                                    <span class="sub-item">商品SKU管理</span>
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <li class="nav-item submenu">
                    <a data-toggle="collapse" href="#cart">
                        <i class="fab fa-cc-amazon-pay"></i>
                        <p>订单与支付</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse <?=$mcart?>" id="cart">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?=url('/'.APP.'/shop_cart/manager')?>"">
                                <span class="sub-item">购物车管理</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?=url('/'.APP.'/shop_order/manager')?>">
                                    <span class="sub-item">订单管理</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?=url('/'.APP.'/shop_pay/manager')?>">
                                    <span class="sub-item">支付管理</span>
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
                                <a href="<?=url('/'.APP.'/trash/shop_category')?>">
                                    <span class="sub-item active">商品分类</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/trash/shop_product')?>">
                                    <span class="sub-item">商品</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=url('/'.APP.'/trash/shop_order')?>">
                                    <span class="sub-item">订单</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>


            </ul>
        </div>
    </div>
</div>
