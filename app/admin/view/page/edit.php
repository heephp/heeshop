<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">页面</h4>
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
                <a href="#">页面管理</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>

                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
<input type="hidden" name="pages_id" value="<?=$m['pages_id']?>">
                        <div class="form-group form-inline">
                            <label class="col-form-label col-md-1" for="inlineinput">路由(访问网址)：</label>
                            <div class="col-md-10">
                            <?=conf('website_url')?>/<input class="" name="route" type="text" placeholder="" value="<?=$m['route']?>">为空表示使用默认网址
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label" for="inlineinput">页面标题</label>
                            <input class="form-control input-full" name="title" type="text" placeholder="" value="<?=$m['title']?>">
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="inlineinput">页面关键词</label>
                            <input class="form-control input-full" name="keyword" type="text" placeholder="" value="<?=$m['keyword']?>">
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="inlineinput">页面描述</label>
                            <textarea  class="form-control input-full" name="description" >
                                <?=$m['description']?>
                            </textarea>
                        </div>



                        <div class="form-group">
                            <label class="col-form-label" for="inlineinput">页面内容</label>
                            
                                <script id="container" name="body" type="text/plain">
                                        <?= html_entity_decode($m['body'])?>
                                    </script>
                        </div>

                        <div class="form-group">
                            <label class="col-form-label" for="inlineinput">模板</label>
                            <div class="row">
                                <input class="form-control col-md-10 input-full" id="template" name="template" type="text" placeholder="" value="<?=$m['template']?>">
                                <input type="button" id="select_template" class=" col-md-2 btn btn-primary" value="选择模板">
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="checkbox" id="sprice" onclick="$('.price').css('display',$('.price').css('display')=='none'?'block':'none');$('.price input').val('')"><label for="sprice">需要购买<span class="text-info">如果不需要购买，则不需要填写</span></label>
                        </div>
                        <div class="form-group price" style="display: none">
                            <label for="link">价格</label>
                            <input type="number" class="form-control" name="price" placeholder="价格" value="<?=$m['price']?>">
                        </div>
<br><BR>
                        <div class="card-action">
                            <input type="submit" class="btn btn-success" value="提交">
                            <input type="reset" class="btn btn-danger" value="重置">
                        </div>
                    </form>
                </div>
            </div>
        </div>





        <?import('/layout/bottom.php');

        ?>
        <?function js(){
            import('/moban/template_select.php');?>

            <!-- 配置文件 -->
            <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.all.js"></script>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                    var ue = UE.getEditor('container',{autoHeightEnabled:false,initialFrameHeight:500});

            </script>


        <?}?>
