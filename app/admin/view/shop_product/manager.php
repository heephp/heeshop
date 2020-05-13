<?import('/layout/shop/header.php');?>
    <div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">商品管理</h4>
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
                <a href="#">商品管理</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/shop/toolsbar.php')?>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">
                                <select class=" select2" name="cls" style="width: auto;" onchange="location.href='<?=url('manager')?>'+$(this).select2('val');">
                                    <option value="">全部分类</option>
                                    <?foreach ($skucls as $s){?>
                                        <option value="<?=$s['cls']?>" <?=$s['cls']==$cls?'selected':''?>><?=$s['cls']?></option>
                                    <?}?>
                                </select>
                            </th>
                            <th scope="col">商品名</th>
                            <th scope="col"><?=mtitle('price',$field,$order,'单价')?></th>
                            <th scope="col"><?=mtitle('stock',$field,$order,'库存')?></th>
                            <th scope="col"><?=mtitle('sellcount',$field,$order,'销量')?></th>
                            <th scope="col"><?=mtitle('hit',$field,$order,'点击')?></th>
                            <th scope="col"><?=mtitle('rate',$field,$order,'评分')?></th>
                            <th scope="col"><?=mtitle('create_time',$field,$order,'创建时间')?></th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['shop_sku_id']?></td>
                                <td><?=$m['name']?></td>
                                <td><?=$m['price']?></td>
                                <td><?=$m['stock']?></td>
                                <td><?=$m['sellcount']?></td>
                                <td><?=$m['hit']?></td>
                                <td><?=$m['rate']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="<?=url('edit/',[$m['shop_product_id']])?>" class="btn btn-primary btn-sm">编辑</a>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$m['shop_product_id'])?>">删除</a>

                                </td>
                            </tr>

                            <?
                        }?>

                        </tbody>
                    </table>
                    <?=$pager?>
                </div>
            </div>
        </div>
    </div>

<?import('/layout/bottom.php');?>
<?function js(){?>


<?}?>