<?import('/layout/header.php');?>
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
                <a href="#">管理</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">订单管理</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>

                            <th scope="col"><?=mtitle('order_id',$field,$order,'订单号')?></th>
                            <th scope="col"><?=mtitle('create_users_id',$field,$order,'用户')?></th>
                            <th scope="col"><?=mtitle('sumprice',$field,$order,'总价')?></th>
                            <th scope="col"><?=mtitle('sourceprice',$field,$order,'原价')?></th>
                            <th scope="col"><?=mtitle('pcount',$field,$order,'商品数')?></th>
                            <th scope="col"><?=mtitle('discount',$field,$order,'折扣')?></th>
                            <th scope="col"><?=mtitle('state',$field,$order,'状态')?></th>
                            <th scope="col"><?=mtitle('create_time',$field,$order,'创建时间')?></th>
                            <th scope="col">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?foreach($list as $m){?>
                            <tr>
                                <td><?=$m['order_id']?></td>
                                <td><?=$m['create_user']['username']?></td>
                                <td><?=$m['sumprice']?></td>
                                <td><?=$m['sourceprice']?></td>
                                <td><?=$m['pcount']?></td>
                                <td><?=$m['discount']?></td>
                                <td><?=get_order_state($m['state'])?></td>
                                <td><?=$m['create_time']?></td>
                                <td>
                                    <?$paylink = '支付宝:\\r\\n'.$_SERVER["HTTP_HOST"].url('/home/alipay/pay',$m['order_id']).'\\r\\n';
                                    $paylink .= '微信支付:\\r\\n'.$_SERVER["HTTP_HOST"].url('/home/wxpay/pay',$m['order_id'])?>
                                    <a href="javascript:void(0);" onclick="alert('<?=$paylink?>')">支付链接</a>
                                    <a href="<?=url('edit',[$m['order_id']])?>" class="btn btn-primary btn-sm">详细</a>
                                    <a href="#" class="btn btn-warning btn-sm delete" url="<?=url('delete',$m['order_id'])?>">清空</a>
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