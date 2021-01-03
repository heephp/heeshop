<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'基本信息']);
function view_content($parms){
    $m = view::getvar('m');
    ?>
                    <form action="<?=url('save')?>" method="post" id="f1" enctype="multipart/form-data">
                        <input type="hidden" name="users_id" value="<?=$m['users_id']?>">
                        <div class="row">
                            <div class="col-xs-8 col-xs-offset-2">
                                <?if(!empty($m['users_id'])){?>
                                    <div style="margin-left: 100px;">
                                        <div class="avatar size-XXL">
                                            <img src="<?=$m['header']?>" id="headerimg" alt="头像" class=" round" onclick="uploadheader()">
                                            <input type="file" name="header" id="header" style="display: none">
                                        </div>
                                    </div>
                                <?}?>

                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="email2">昵称</label>
                                    <div class="formControls col-sm-12 col-md-5"> <input type="text" class="input-text" name="nickname" placeholder="昵称" value="<?=$m['nickname']?>"> </div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2">性别：</label>
                                    <div class="formControls col-sm-12 col-md-2">
                                        <select class="select" name="sex">
                                            <option value="1" <?$m['sex']=='1'?'selected':''?>>男</option>
                                            <option value="0" <?$m['sex']=='0'?'selected':''?>>女</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="birthday">生日</label>
                                    <div class="formControls col-sm-12 col-md-3"> <input type="text" class="input-text datepicker" name="birthday" value="<?=$m['birthday']?>" placeholder=""></div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="country">国家</label>
                                    <div class="formControls col-sm-12 col-md-5"><select class="select" name="country_id">
                                        <?foreach (view::getvar('countries') as $c){?>
                                            <option value="<?=$c['country_id']?>"><?=$c['name'].' - '.$c['code']?></option>
                                        <?}?>
                                    </select></div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="city">城市</label>
                                    <div class="formControls col-sm-12 col-md-3"><input type="text" class="input-text" name="city" placeholder="城市" value="<?=$m['city']?>"></div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="address">地址</label>
                                    <div class="formControls col-sm-12 col-md-6"><input type="text" class="input-text" name="address" placeholder="地址" value="<?=$m['address']?>"></div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="postcode">邮编</label>
                                    <div class="formControls col-sm-12 col-md-3"><input type="number" style="width: 100%" class="input-text" name="postcode" placeholder="200010" value="<?=$m['postcode']?>"></div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="email">邮箱</label>
                                    <div class="formControls col-sm-12 col-md-5"><input type="email" class="input-text" name="email" placeholder="@abc.com" value="<?=$m['email']?>"></div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="wechat">微信</label>
                                    <div class="formControls col-sm-12 col-md-3"><input type="text" class="input-text" name="wechat" placeholder="weixin" value="<?=$m['wechat']?>"></div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="mobile">手机</label>
                                    <div class="formControls col-sm-12 col-md-3"><input type="tel" class="input-text" name="mobile" placeholder="131" value="<?=$m['mobile']?>"></div>
                                </div>
                                <div class="row cl mt-10">
                                    <label class="form-label col-sm-12 col-md-2" for="qq">QQ</label>
                                    <div class="formControls col-sm-12 col-md-3"><input type="number" style="width: 100%" class="input-text" name="qq" placeholder="QQ" value="<?=$m['qq']?>"></div>
                                </div>
                            </div>
                        </div>

                        <p></p><p></p>
                        <br><br>
                        <div class="card-action col-xs-offset-3">
                            <input type="hidden" name="crsf" value="<?=crsf()?>">
                            <input type="submit" class="btn btn-primary radius" value="提交">
                            <input type="reset" class="btn btn-primary-outline radius" value="重置">
                        </div>

                        </div>
                    </form>
<?php }
function view_script(){
    ?>
        <script src="__res__js/default.js"></script>
    <script>
        function uploadheader(){
            $('#header').click();
        }
        $('#header').change(function(e){
            uploadfile("<?=url('uploadheader')?>",'header','f1',function (data){
                if(data.state=='ok'){
                    $('#headerimg').attr('src',data.msg);
                }else{
                    if(data.msg!=undefined)
                        msg('头像上传',data.msg,2)
                    else
                        alert(JSON.stringify(data));
                }
            })
        })
        $(".datepicker").datetimepicker({
            language: "zh-cn",
            format: "yyyy-mm-dd hh:ii",
            autoclose: true
        });
    </script>
<?php
}
?>