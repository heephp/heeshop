<?import('/layout/shop/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">订单管理</h4>
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
                <a href="#">订单详细</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <h5>订单号：<?=$order_id?>订单商品列表：<br></h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">商品</th>
                            <th scope="col">数量</th>
                            <th scope="col">单价</th>
                            <th scope="col">总价</th>
                            <th scope="col">状态</th>
                            <th scope="col">创建时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?if(!empty($list))
                        foreach($list as $m){?>
                            <tr>
                                <td><?=$m['product']['name']?></td>
                                <td><?=$m['num']?></td>
                                <td><?=$m['price']?></td>
                                <td><?=($m['sumprice'])?></td>
                                <td><?=$m['state']?></td>
                                <td><?=$m['create_time']?></td>
                                <td>

                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('refund/'.$m['shop_order_detail_id'])?>">退款</a>

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
