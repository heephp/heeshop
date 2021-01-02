<?php
use heephp\view;
view::create();
view::import('../layout/header',['title'=>'用户中心']);?>
    <div class="row cl mt-35">
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-primary">
                <div class="panel-header">用户中心</div>
                <div class="panel-body">
                    <ul>
                        <li><a href="<?=url('edit')?>" >基本信息</a></li>
                        <li><a href="<?=url('edit')?>" >我的等级</a></li>
                        <li><a href="<?=url('edit')?>" >我的收件箱</a></li>
                        <li><a href="<?=url('edit')?>" >发消息</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary mt-20">
                <div class="panel-header">信息管理</div>
                <div class="panel-body">
                    <ul>
                        <li><a href="<?=url('infopublish')?>" >发布信息</a></li>
                        <li><a href="<?=url('infomanager')?>" >管理信息</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary mt-20">
                <div class="panel-header">订单管理</div>
                <div class="panel-body">
                    <ul>
                        <li><a href="<?=url('orders')?>" >订单管理</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-9">
            <h1>用户中心</h1>
            <h3>欢迎您的登录：<?=request('session.user_name')?></h3>
            <h5>这是您第<?=$user_loginnum?>次登录</h5>
            <h5>您发布了0条信息，您有0个订单</h5>
        </div>
    </div>
<?php
view::import('../layout/bottom');?>