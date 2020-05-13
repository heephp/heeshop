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
                <a href="#">创建订单</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>
                        快速创建订单
                    </h3>
                    <form action="<?=url('save_insert')?>" method="post">
                        <input type="hidden" name="shop_order_id" value="">
                        <input type="hidden" name="contact" value="1">
                        <input type="hidden" name="address" value="1">
                        <input type="hidden" name="mobile" value="1">
                    <div class="form-group">
                        <label for="name">价格</label>
                        <input type="text" class="form-control" name="sumprice" id="sumprice" placeholder="价格"
                               value="">
                    </div>
                    <input type="submit" class="btn btn-primary" value="快速创建">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?
    import('/layout/bottom.php');

    ?>

    <?function js(){?>


    <?}?>
