<?import('/layout/shop/header.php');?>
    <div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">支付管理</h4>
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
                <a href="#">支付记录</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd">

                        <li class="nav-item">
                            <a class="nav-link" href="<?=url('clear_nopay')?>" ><i class="icon-note"></i> 清空未支付记录</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col"><?=mtitle('shop_pay_id',$field,$order,'流水号')?></th>
                            <th scope="col">订单号</th>
                            <th scope="col">支付金额</th>
                            <th scope="col">用户</th>
                            <th scope="col">状态</th>
                            <th scope="col">创建时间</th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['shop_pay_id']?></td>
                                <td><?=$m['shop_order_id']?></td>
                                <td><?=$m['money']?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['state']?'已支付':'未支付'?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm" onclick="alert('<?=$m['restr']?>')">详细</a>
                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete/'.$m['shop_pay_id'])?>">删除</a>
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