<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">链接组</h4>
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
                <a href="#">链接组编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="link_group_id" value="<?=$m['link_group_id']?>">
                        <div class="row">
                            <div class="col-lg-6">


                                <div class="form-group">
                                    <label for="title">标记</label>
                                    <input type="text" class="form-control" name="tag" placeholder="标题" value="<?=$m['tag']?>">
                                    <small>英文字符（以方便在模板中引用），不少于5个</small>
                                </div>
                                <div class="form-group">
                                    <label for="link">名称</label>
                                    <input type="text" class="form-control" name="title" placeholder="链接" value="<?=$m['title']?>">
                                </div>
                                <div class="form-group">
                                    <label for="parent_id">启用</label>
                                    <select class="form-control" name="disable">
                                        <option value="1" <?=$m['disable']===1?'selected':''?>>启用</option>
                                        <option value="0"<?=$m['disable']===0?'selected':''?>>停用</option>
                                    </select>
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

    ?>

    <?function js(){?>


    <?}?>
