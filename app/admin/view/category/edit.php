<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">栏目</h4>
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
                <a href="#">栏目编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <form action="<?=url('save')?>" method="post">

                <div class="card-body">

                    <ul class="nav nav-tabs nav-secondary" id="pills-tab" role="tablist">
                        <li class="nav-item submenu">
                            <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">基本</a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-template-tab" data-toggle="pill" href="#pills-template" role="tab" aria-controls="pills-template" aria-selected="true">模型与模板</a>
                        </li>
                    </ul>



                    <div class="tab-content mt-2 mb-3" id="pills-tabContent">

                        <div class="tab-pane fade  show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <input type="hidden" name="category_id" value="<?=$m['category_id']?>">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="parent_id">父级</label>
                                            <select class="form-control" name="parent_id">
                                                <option value="0">无</option>
                                                <?foreach ($plist as $p){?>
                                                    <option value="<?=$p['category_id']?>" <?=$p['category_id']==$m['parent_id']?'selected':''?>><?=$p['name']?></option>
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
                                            <label for="title">名称</label>
                                            <input type="text" class="form-control" name="name" placeholder="名称" value="<?=$m['name']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="link">关键词</label>
                                            <input type="text" class="form-control" name="keyword" placeholder="关键词" value="<?=$m['keyword']?>">
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




                        </div>

                        <div class="tab-pane fade" id="pills-template" role="tabpanel" aria-labelledby="pills-template-tab">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="parent_id">模型</label>
                                        <select class="form-control" name="model_id">
                                            <option value="0">无</option>
                                            <?foreach ($mlist as $t){?>
                                                <option value="<?=$t['model_id']?>" <?=$t['model_id']==$m['model_id']?'selected':''?>><?=$t['name']?></option>
                                            <?}?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title">列表模板</label>
                                        <input type="text" class="form-control" name="template_list" placeholder="列表模板" value="<?=$m['template_list']??'list.php'?>">
                                        <small class="text-small">列表页使用的模板,相对view根目录的路径以'/'开头，相对view/栏目名/目录的无需'/'开头</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">详细页模板</label>
                                        <input type="text" class="form-control" name="template_detail" placeholder="详细页模板" value="<?=$m['template_detail']??'detail.php'?>">
                                        <small class="text-small">详细页使用的模板,相对view根目录的路径以'/'开头，相对view/栏目名/目录的无需'/'开头</small>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

            </div>
                <div class="card-footer">
                    <input type="submit" class="btn btn-success" value="提交">
                    <input type="reset" class="btn btn-danger" value="重置">
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
