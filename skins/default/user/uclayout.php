<?php
use heephp\view;
view::create();
view::import('../layout/header',['title'=>$title.'-用户中心']);?>
    <div class="row cl mt-35">
        <div class="col-sm-12 col-md-3">
            <div class="panel panel-primary">
                <div class="panel-header">用户中心</div>
                <div class="panel-body">
                    <ul>
                        <li><a href="<?=url('edit')?>" >基本信息</a></li>
                        <li><a href="<?=url('inbox')?>" >我的收件箱（<font color="red"><?=$noread?></font>）</a></li>
                        <li><a href="<?=url('sendmsg')?>" >发消息</a></li>
                    </ul>
                </div>
            </div>
            <div class="panel panel-primary mt-20">
                <div class="panel-header">信息管理</div>
                <div class="panel-body">
                    <ul>
                        <li><a href="<?=url('publish')?>" >发布信息</a></li>
                        <li><a href="<?=url('manager')?>" >管理信息</a></li>
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
            <?php view::part('content');?>
        </div>
    </div>
<?php
view::import('../layout/bottom');?>