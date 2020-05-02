<?import('/layout/header.php')?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">模型</h4>
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
                <a href="#">模型编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">


                                <form action="<?=url('save')?>" method="post">
                                    <input type="hidden" name="model_id" value="<?=$m['model_id']?>">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="title">模型名</label>
                                                <input type="text" class="form-control" name="name" placeholder="标题" value="<?=$m['name']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="link">关联表</label>
                                                <select class="form-control" name="model_table_id">
                                                    <option value="0">无</option>
                                                    <?foreach ($mt as $t){?>
                                                        <option value="<?=$t['model_table_id']?>" <?=$t['model_table_id']==$m['model_table_id']?'selected':''?>><?=$t['name']?></option>
                                                    <?}?>
                                                </select>

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


                            </form>

                    </div>
                </div>
            </div>
        </div>



<?import('/layout/bottom.php')?>
<?function js(){?>

<?}?>
