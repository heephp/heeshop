<?php
use heephp\view;
view::create();
view::import('../layout/header',['title'=>'注册']);?>
<div class="row cl mt-35">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="panel panel-primary">
            <div class="panel-header">注册新用户</div>
            <div class="panel-body">
                <form action="<?=url('reg_action')?>" method="post" enctype="application/x-www-form-urlencoded">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">登录名*：</div>
                        <div class="col-sm-12 col-md-8"><input type="text" class="input-text radius" name="username" placeholder="登录名"></div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-sm-12 col-md-4">昵称*：</div>
                        <div class="col-sm-12 col-md-8"><input type="text" class="input-text radius" name="nickname" placeholder="昵称"></div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-sm-12 col-md-4">密码*：</div>
                        <div class="col-sm-12 col-md-8"><input type="password" class="input-text radius" name="password" placeholder="密码"></div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-sm-12 col-md-4">确认密码*：</div>
                        <div class="col-sm-12 col-md-8"><input type="password" class="input-text radius" name="cfmpassword" placeholder="确认密码"></div>
                    </div>
                    <div class="row mt-10">
                        <div class="col-sm-12 col-md-4">Email*：</div>
                        <div class="col-sm-12 col-md-8"><input type="email" class="input-text radius" name="email" placeholder="email"></div>
                    </div>
                    <?if(conf('is_vcode')){?>
                        <div class="row mt-10" style="overflow: hidden">
                            <div class="col-sm-12 col-md-4">验证码*：</div>
                            <div class="col-sm-12 col-md-4"><input type="text" class="input-text radius"  name="vcode" placeholder="验证码"></div>
                            <div class="col-sm-12 col-md-4"><img src="<?=url('vcode')?>" id="vcode"></div>
                        </div>
                    <?}?>
                    <div class="row mt-10">
                        <input type="hidden" name="crsf" value="<?=crsf()?>">
                        <div class="col-sm-12 col-md-4 col-md-offset-4"><input class="btn btn-primary radius" type="submit" value="提交"></div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
<?php
view::import('../layout/bottom');?>
