<?import('/layout/shop/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">商品SKU</h4>
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
                <a href="#">编辑</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/shop/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="shop_sku_id" value="<?=$m['shop_sku_id']?>">

                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="title">分类</label>
                                    <select class="form-control select2input" name="cls">
                                        <?foreach ($skucls as $s){?>
                                        <option value="<?=$s['cls']?>" <?=$s['cls']==$m['cls']?'selected':''?>><?=$s['cls']?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="link">显示</label>
                                    <input type="text" class="form-control" name="txt" placeholder="显示" value="<?=$m['txt']?>">
                                </div>
                                <div class="form-group">
                                    <label for="link">值</label>
                                    <input type="text" class="form-control" name="val" placeholder="值" value="<?=$m['val']?>">


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
