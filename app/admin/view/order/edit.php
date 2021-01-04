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
                <a href="<?=url('order/manager')?>">订单管理</a>
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

                    <h4 style="line-height: 22px;">订单号：<?=$m['order_id']?>
                        <br>
                        金额：<span class="text-danger"> <?=$m['sumprice']?></span><br>
                        原价：<?=$m['sourceprice']?><br>
                        折扣：<?=$m['discount']?><br>
                        商品总数：<?=$m['pcount']?><br>
                        状态：<span class="text-danger"><?=get_order_state($m['state'])?></span><br>
                        创建时间：<?=$m['create_time']?><br>
                        订单详细列表：
                    </h4>
                    <table class="table">
                        <thead>
                        <tr class="text-c">
                            <th>产品</th>
                            <th>数量</th>
                            <th>单价</th>
                            <th>总价</th>
                            <th>创建时间</th>
                        </tr>
                        </thead>
                        <tbody class="getData-list" data-currpage="1">
                        <? foreach ($m['detail'] as $item){?>
                            <tr class="text-c">
                                <td class="text-l"><a style="cursor:pointer" class="text-primary" title="查看"><?=!empty($item['product']['title'])?$item['product']['title']:$item['product']['name']?></a></td>
                                <td><?=$item['num']?></td>
                                <td><?=$item['price']?></td>
                                <td><?=$item['sumprice']?></td>
                                <td><?=$item['create_time']?></td>
                            </tr>
                        <? }?>
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
