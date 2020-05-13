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
                <a href="#">购物车详细</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

<h5>用户：<?=$list[0]['create_user']['username'] ??''?>购物车商品列表：<br></h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">用户</th>
                            <th scope="col">商品</th>
                            <th scope="col">数量</th>
                            <th scope="col">单价</th>
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
                                <td><?=$m['num']?></td>
                                <td><?=$m['price']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete_product/'.$m['shop_cart_id'])?>">清空</a>

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
    <?
    import('/layout/bottom.php');

    ?>

    <?function js(){?>


    <?}?>
