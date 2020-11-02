<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">模板</h4>
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
                <a href="#">选择模板</a>
            </li>

        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form action="<?=url('save')?>" method="get">
                        <div class="d-flex flex-wrap">
                            <?php foreach ($skins as $s){?>
                            <div class="flex-1"><label for="<?=$s['title']?>"> <img src="<?=$s['img']?>" width="200" height="200" class="border"><br> <h5><input type="radio" id="<?=$s['title']?>" name="moban" value="<?=$s['title']?>" <?=$s['checked']?>><?=$s['title']?></h5></label></div>
                            <?php }?>
                        </div>

                    <input type="submit" class="btn btn-primary" value="启用"> <a href="javascript:void(0);" data-toggle="modal" data-target="#pop"><small> 如何安装新模板？</small></a>
                    </form>
                </div>
            </div>
        </div>


        <!-- 模态框（Modal） -->
        <div class="modal fade" id="pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">在官网下载模板zip文件。<br>

                        解压后：(为两个目录)<br>1、将模板目录放在skins目录下；<br>2、将static目录下文件放在'public/static/skins/'目录。<br>刷新此页面后自动识别模板。<br>选择模板后启用</div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal -->
        </div>


        <?import('/layout/bottom.php');?>
        <?function js(){?>


        <?}?>
