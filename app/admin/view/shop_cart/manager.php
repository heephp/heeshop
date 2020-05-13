<?import('/layout/shop/header.php');?>
    <div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">购物车管理</h4>
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
                <a href="#">购物车管理</a>
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
                            <th scope="col">用户</th>
                            <th scope="col">商品</th>
                            <th scope="col">总数</th>
                            <th scope="col">总价</th>
                            <th scope="col">创建时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['shop_cart_id']?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['product']['name']?></td>
                                <td><?=$m['pcount']?></td>
                                <td><?=$m['pricecount']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="<?=url('edit/',[$m['create_user']['users_id']])?>" class="btn btn-primary btn-sm">查看</a>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$m['create_user']['users_id'])?>">清空</a>

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