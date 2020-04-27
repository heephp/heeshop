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
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="users_group_id" value="<?=$m['users_group_id']?>">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="name">用户组名</label>
                                    <input type="text" class="form-control" name="name" placeholder="用户名" value="<?=$m['name']?>" >
                                </div>
                                <div class="form-group">
                                    <label for="remark">备注</label>
                                    <textarea type="text" class="form-control" name="remark" placeholder="备注" >
                                        <?=$m['remark']?>
                                    </textarea>
                                </div>
                                <div class="form-group form-inline">

                                    <input type="checkbox" class="" id="isadmin" value="1" name="isadmin" <?=$m['isadmin']?'checked':''?> >
                                    <label for="isadmin">是否管理员</label>
                                    <small>仅管理员可以登录后台</small>
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


    <?}?>
