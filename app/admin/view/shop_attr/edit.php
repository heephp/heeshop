<?import('/layout/shop/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">商品属性</h4>
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
                <a href="#">属性编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/shop/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">

                        <div class="row">
                            <div class="col-lg-3">

                                <div class="form-group">
                                    <label for="title">分类</label>
                                    <select class="form-control select2input" name="name">
                                        <?foreach ($attrs as $s){?>
                                            <option value="<?=$s['name']?>" <?=$s['name']==$m['name']?'selected':''?>><?=$s['name']?></option>
                                        <?}?>
                                    </select>
                                    <small>选择或输入分类</small>
                                </div>
                                <div class="form-group">
                                    <label for="link">项目</label>
                                    <input type="text" class="form-control" name="value" placeholder="项目" value="">
                                </div>
                            </div>
                        </div>

                        <p></p>
                        <div class="card-action">
                            <input type="submit" class="btn btn-success" value="添加">
                            <input type="reset" class="btn btn-danger" value="重置">
                        </div>
                    </form>
                        <p></p>
                        <h3>项目列表</h3>
                        <div class="row">

                            <div class="col-md-3">

                                <table class="table-bordered table table-responsive-sm">
                                    <?
                                    if($m&&!empty($m['values'])){
                                    foreach ($m['values'] as $v){
                                        if(empty($v))
                                            continue;?>
                                    <tr>
                                        <td><?=$v?></td>
                                        <td><a href="<?=url('delete',[$m['name'],$v])?>" class="btn btn-danger btn-sm"> 删除</a></td>
                                    </tr>
                                    <?}}else{echo'空';}?>
                                </table>

                            </div>

                        </div>

                </div>
            </div>
        </div>
    </div>


    <?
    import('/layout/bottom.php');

    ?>

    <?function js(){?>


    <?}?>
