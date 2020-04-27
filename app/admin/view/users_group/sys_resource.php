<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">权限管理</h4>
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
                <a href="#">权限管理</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">用户组权限</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form action="<?=url('save_sys_resource')?>" method="post">
                <div class="card-header">

                    <div class="form-group">
                        <label for="parent_id">选择要设置权限的用户组</label>
                        <select class="form-control" name="users_group_id" onchange="location.href='<?=url('sys_resource')?>/'+this.value">
                            <option value="0">无</option>
                            <?foreach ($uglist as $g){?>
                                <option value="<?=$g['users_group_id']?>" <?=$ugid==$g['users_group_id']?'selected':''?>><?=$g['name']?></option>
                            <?}?>
                        </select>
                    </div>


                </div>

                <div class="card-body">

                    <?
                    if(!empty($ugid)){
                        foreach($resplist as $item){?>
                            <div class="card-sub">
                                <b><?=$item['title']?></b>
                            </div>
                            <p>
                            <div class="selectgroup selectgroup-pills">

                                <?foreach ($item['child'] as $r){?>
                                <label class="selectgroup-item">
                                    <input name="sys_resources_id[]" class="selectgroup-input" type="checkbox" value="<?=$r['sys_resources_id']?>" <?=isset($ugres)&&in_array($r['sys_resources_id'],$ugres)?'checked':''?>>
                                    <span class="selectgroup-button"><?=$r['title']?></span>
                                </label>
                                <?}?>

                            </div>
                            <br><br>
                            </p>
                        <?}?>

                        <div class="card-action">
                            <input type="submit" class="btn btn-success" value="提交">
                            <input type="reset" class="btn btn-danger" value="重置">
                        </div>
                    <?}?>
                </div>
                </form>
            </div>
        </div>
    </div>

</div>
<?import('/layout/bottom.php');?>
<?function js(){?>


<?}?>
