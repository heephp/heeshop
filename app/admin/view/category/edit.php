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

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">基本</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="adv-tab" data-toggle="tab" href="#adv" role="tab" aria-controls="adv" aria-selected="false">高级</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-2" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="tab-pane fade  show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <input type="hidden" name="category_id" value="<?=$m['category_id']?>">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="parent_id">父级栏目</label>
                                                <select class="form-control select2" name="parent_id">
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

                        </div>
                        <div class="tab-pane fade" id="adv" role="tabpanel" aria-labelledby="adv-tab">
                            <div class="form-group">
                                <label class="col-form-label" for="inlineinput">模板</label>
                                <div class="row">
                                    <input class="form-control col-md-2 input-full" id="template" name="template" type="text" placeholder="" value="<?=$m['template']??'list'?>">
                                    <input type="button" id="select_template" class=" col-md-1 btn btn-primary" value="选择模板">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="sprice" onclick="$('.price').css('display',$('.price').css('display')=='none'?'block':'none');$('.price input').val('')"><label for="sprice">需要购买</label><span class="text-info">如果不需要购买，则不需要填写</span>
                            </div>
                            <div class="form-group price" style="display: none">
                                <label for="link">价格</label>
                                <input type="number" class="form-control col-3" name="price" placeholder="价格" value="<?=$m['price']??'0'?>">
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

    <?function js(){
        import('/moban/template_select.php');?>

        <script src="/assets/plugin/fileTree/jquery.easing.js" type="text/javascript"></script>

    <?}?>
