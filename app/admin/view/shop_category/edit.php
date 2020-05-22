<?import('/layout/shop/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">商品分类</h4>
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
                <a href="#">分类编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/shop/toolsbar.php')?>
                <form action="<?=url('save')?>" method="post">

                    <div class="card-body">

                        <ul class="nav nav-tabs nav-secondary" id="pills-tab" role="tablist">
                            <li class="nav-item submenu">
                                <a class="nav-link active show" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">基本</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link" id="pills-attr-tab" data-toggle="pill" href="#pills-attr" role="tab" aria-controls="pills-attr" aria-selected="true">属性</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link" id="pills-sku-tab" data-toggle="pill" href="#pills-sku" role="tab" aria-controls="pills-sku" aria-selected="true">SKU</a>
                            </li>
                        </ul>



                        <div class="tab-content mt-2 mb-3" id="pills-tabContent">

                            <div class="tab-pane fade  show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                <input type="hidden" name="shop_category_id" value="<?=$m['shop_category_id']?>">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="parent_id">父级</label>
                                            <select class="form-control select2" name="parent_id">
                                                <option value="0">无</option>
                                                <?foreach ($plist as $p){?>
                                                    <option value="<?=$p['shop_category_id']?>" <?=$p['shop_category_id']==$m['parent_id']?'selected':''?>><?=$p['name']?></option>
                                                <?}?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="title">名称</label>
                                            <input type="text" class="form-control" name="name" placeholder="名称" value="<?=$m['name']?>">
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

                            <div class="tab-pane fade" id="pills-attr" role="tabpanel" aria-labelledby="pills-attr-tab">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="form-group">
                                            <label for="skus">属性</label>
                                            <select class="form-control select2" multiple="true" name="attrs[]" placeholder="属性">
                                                <?
                                                $attrsnames = array_column($m['attrs'],'name');
                                                foreach ($attrs as $s){
                                                    ?>
                                                    <option value="<?=$s['name']?>" <?=(isset($m)&&!empty($m['attrs'])&&in_array($s['name'],$attrsnames))?'selected':''?>><?=$s['name']?></option>
                                                <?}?>
                                            </select>
                                        </div>


                                    </div>

                                </div>
                            </div>


                            <div class="tab-pane fade" id="pills-sku" role="tabpanel" aria-labelledby="pills-sku-tab">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="form-group">
                                            <label for="skus">SKU</label>
                                            <select class="form-control select2" multiple="true" name="skus[]">
                                                <?$m['skus']=array_column($m['skus'],'shop_sku_cls');
                                                foreach ($skus as $s){?>
                                                    <option value="<?=$s['cls']?>" <?=(isset($m)&&!empty($m['skus'])&&in_array($s['cls'],$m['skus']))?'selected':''?>><?=$s['cls']?></option>
                                                <?}?>
                                            </select>
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

    ?>

    <?function js(){?>


    <?}?>
