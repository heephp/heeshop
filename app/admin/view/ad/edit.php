<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">广告</h4>
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
                <a href="#">广告管理</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">广告编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="ad_id" value="<?=$m['ad_id']?>">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control" name="title" placeholder="标题" value="<?=$m['title']?>">
                                </div>
                                <div class="form-group">
                                    <label for="link">链接</label>
                                    <input type="text" class="form-control" name="link" placeholder="链接" value="<?=$m['link']?>">
                                </div>
                                <div class="form-group">
                                    <label for="link">内容</label>
                                    <input type="text" class="form-control" name="content" placeholder="排序" value="<?=$m['content']?>">
                                </div>
                                <div class="form-group">
                                    <label for="remark">代码</label>
                                    <textarea type="text" class="form-control" name="code" placeholder="备注" >
                                        <?=$m['code']?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="link">点击量</label>
                                    <input type="text" class="form-control" name="hit" value="<?=$m['hit']?>" disabled readonly>
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
