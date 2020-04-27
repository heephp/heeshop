<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">菜单</h4>
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
                <a href="#">菜单编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="menus_id" value="<?=$m['menus_id']?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="parent_id">父级</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">无</option>
                                        <?foreach ($plist as $p){?>
                                            <option value="<?=$p['menus_id']?>" <?=$p['menus_id']==$m['parent_id']?'selected':''?>><?=$p['title']?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">图标</label>
                                    <div class="input-group">
                                        <input class="form-control" name="icon" id="icon" type="text" readonly value="<?=$m['icon']?>">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary dropdown-toggle" data-toggle="modal" data-target="#modal-icon_select" type="button">选择图标</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control" name="title" placeholder="标题" value="<?=$m['title']?>">
                                </div>
                                <div class="form-group">
                                    <label for="link">链接</label>
                                    <input type="text" class="form-control" name="link" placeholder="链接" value="<?=$m['link']?>">
                                </div>
                                <div class="form-group">
                                    <label for="link">排序</label>
                                    <input type="text" class="form-control" name="ord" placeholder="排序" value="<?=$m['ord']?>">
                                </div>
                                <div class="form-group">
                                    <label for="remark">备注</label>
                                    <textarea type="text" class="form-control" name="remark" placeholder="备注" >
                                        <?=$m['remark']?>
                                    </textarea>
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

    <?
    import('/layout/bottom.php');
    import('/share/icon/select.php');

    ?>

    <?function js(){?>


    <?}?>
