<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'发送消息']);
function view_content(){
    ?>
    <form action="<?=url('sendmsg_action')?>" method="post">
        <div class="row">
            <div class="col-lg-12">
                <div class="row cl mt-20">
                    <label class="col-sm-12 col-md-2" for="receiver">收件人</label>
                    <div class="formControls col-sm-12 col-md-8"> <input type="text" class="input-text radius"  name="receiver" value="<?=view::getvar('re')?>"></div>
                    <br>
                    <span>多个用户用,号分隔</span>
                </div>
                <div class="row cl mt-20">
                    <label class="col-sm-12 col-md-2" for="title">标题</label>
                    <div class="formControls col-sm-12 col-md-8"><input type="text" class="input-text radius" name="title" placeholder="标题"></div>
                </div>
                <div class="row cl mt-20">
                    <label class="col-sm-12 col-md-2"  for="context">内容</label>
                    <div class="formControls col-sm-12 col-md-8"><textarea type="text" class="textarea radius" name="context" placeholder="内容" ></textarea></div>
                </div>
                <?if(conf('is_vcode')){?>
                    <div class="row mt-10" style="overflow: hidden">
                        <div class="col-sm-12 col-md-2">验证码：</div>
                        <div class="col-sm-12 col-md-2"><input type="text" class="input-text radius" name="vcode" placeholder="验证码"></div>
                        <div class="col-sm-12 col-md-2"><img src="<?=url('vcode')?>" id="vcode"></div>
                    </div>
                <?}?>

                <p></p><p></p>
                <div class="card-action col-md-offset-2">
                    <input type="hidden" name="crsf" value="<?=crsf()?>">
                    <input type="submit" class="btn btn-success" value="发送">
                    <input type="reset" class="btn btn-danger" value="重置">
                </div>

            </div>
        </div>
    </form>
<?php }?>

