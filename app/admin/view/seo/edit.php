<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">SEO</h4>
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
                <a href="#">SEO优化</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">

                    <div class="form-group form-inline">
                        <label class="col-md-1 col-form-label" for="inlineinput">网站名称</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="website_name" type="text" placeholder="" value="<?=$m['website_name']?>">
                        </div>
                    </div>

                     <div class="form-group form-inline">
                        <label class="col-md-1 col-form-label" for="inlineinput">网站关键词</label>
                        <div class="col-md-9 p-0">
                            <textarea class="form-control input-full" name="website_keyword" type="text" placeholder=""><?=$m['website_keyword']?></textarea>
                            <br>
                            使用 ;|，,空格 都可以分隔关键词  <a href="http://paiming.heecms.cn" target="_blank">使用排名查询工具查询关键词排名?</a>
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-1 col-form-label" for="inlineinput">网站描述</label>
                        <div class="col-md-9 p-0">
                            <textarea  class="form-control input-full" name="website_description" >
                                <?=$m['website_description']?>
                            </textarea>
                        </div>
                    </div>

                    <div class="card-action">
                        <input type="submit" class="btn btn-success" value="提交">
                        <input type="reset" class="btn btn-danger" value="重置">
                    </div>
                    </form>
                </div>
        </div>
    </div>

    <?import('/layout/bottom.php');?>
    <?function js(){?>


    <?}?>
