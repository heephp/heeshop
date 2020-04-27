<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">用户</h4>
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
                <a href="#">用户信息编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post" id="f1" enctype="multipart/form-data">
                        <input type="hidden" name="users_id" value="<?=$m['users_id']?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <?if(!empty($m['users_id'])){?>
                            <div class="form-group" align="center">
                                <div class="avatar avatar-xxl" align="center">
                                    <img class="avatar-img rounded-circle" alt="更换头像" id="headerimg" src="<?=$m['header']?>" style="cursor: pointer" onclick="uploadheader()"><br>
                                    <input type="file" name="header" id="header" style="display: none">
                                </div>
                            </div>
                            <?}?>
                            <div class="form-group">
                                <label for="username">用户名</label>
                                <input type="text" class="form-control" <?=!empty($m['users_id'])?'disabled':''?> name="username" placeholder="用户名" value="<?=$m['username']?>">
                            </div>
                            <div class="form-group">
                                <label for="username">密码</label>
                                <input type="text" class="form-control"  name="password" placeholder="">
                                <small class="form-text text-muted" id="passwordhelp">如果不修改密码，保留空即可</small>
                            </div>
                            <div class="form-group">
                                <label for="email2">昵称</label>
                                <input type="text" class="form-control" name="nickname" placeholder="昵称" value="<?=$m['nickname']?>">
                            </div>
                            <div class="form-group">
                                <label for="country">用户组</label>
                                <select class="form-control" name="users_group_id">
                                    <?foreach ($ugroups as $g){?>
                                        <option value="<?=$g['users_group_id']?>" <?=$g['users_group_id']==$m['users_group_id']?'selected':''?>><?=$g['name']?></option>
                                    <?}?>
                                </select>
                            </div>
                            <div class="form-check">
                                <label>性别</label><br>
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="sex" value="男" <?=$m['sex']=='男'?'checked':''?>>
                                    <span class="form-radio-sign">男</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="sex" value="女" <?=$m['sex']=='女'?'checked':''?>>
                                    <span class="form-radio-sign">女</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="birthday">生日</label>
                                <input type="date" class="form-control datepicker" name="birthday" value="<?=$m['birthday']?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="country">国家</label>
                                <select class="form-control" name="country_id">
                                    <?foreach ($countries as $c){?>
                                    <option value="<?=$c['country_id']?>"><?=$c['name'].' - '.$c['code']?></option>
                                    <?}?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city">城市</label>
                                <input type="text" class="form-control" name="city" placeholder="城市" value="<?=$m['city']?>">
                            </div>
                            <div class="form-group">
                                <label for="address">地址</label>
                                <input type="text" class="form-control" name="address" placeholder="地址" value="<?=$m['address']?>">
                            </div>
                            <div class="form-group">
                                <label for="postcode">邮编</label>
                                <input type="number" class="form-control" name="postcode" placeholder="200010" value="<?=$m['postcode']?>">
                            </div>
                            <div class="form-group">
                                <label for="email">邮箱</label>
                                <input type="email" class="form-control" name="email" placeholder="@abc.com" value="<?=$m['email']?>">
                            </div>
                            <div class="form-group">
                                <label for="wechat">微信</label>
                                <input type="text" class="form-control" name="wechat" placeholder="weixin" value="<?=$m['wechat']?>">
                            </div>
                            <div class="form-group">
                                <label for="mobile">手机</label>
                                <input type="number" class="form-control" name="mobile" placeholder="131" value="<?=$m['mobile']?>">
                            </div>
                            <div class="form-group">
                                <label for="qq">QQ</label>
                                <input type="number" class="form-control" name="qq" placeholder="QQ" value="<?=$m['qq']?>">
                            </div>
                        </div>
                    </div>

                    <p></p><p></p>
                    <div class="card-action">
                        <input type="submit" class="btn btn-success" value="提交">
                        <input type="reset" class="btn btn-danger" value="重置">
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>

    <?import('/layout/bottom.php');?>
    <?function js(){?>
        <script>
        function uploadheader(){
            $('#header').click();

        }
        $('#header').change(function(e){
            uploadfile("<?=url('uploadheader')?>",'header','f1',function (data){
                alert(data.state)
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
        </script>
    <?}?>
