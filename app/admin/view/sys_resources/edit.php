<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">资源</h4>
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
                <a href="#">资源编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="sys_resources_id" value="<?=$m['sys_resources_id']?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="parent_id">父级</label>
                                    <select class="form-control" name="parent_id" value="<?=$m['parent_id']?>">
                                        <option value="0">无</option>
                                        <?foreach ($plist as $g){?>
                                            <option value="<?=$g['sys_resources_id']?>" <?=($m['parent_id']==$g['sys_resources_id'])?'selected':''?>><?=$g['title']?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control" name="title" placeholder="标题" value="<?=$m['title']?>">
                                </div>
                                <div class="form-group">
                                    <label for="path">路径</label>
                                    <input type="text" class="form-control" name="path" placeholder="路径" value="<?=$m['path']?>">
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

    <?import('/layout/bottom.php');?>
    <?function js(){?>


    <?}?>
