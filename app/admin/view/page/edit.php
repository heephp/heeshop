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
<br><BR>
                        <div class="card-action">
                            <input type="submit" class="btn btn-success" value="提交">
                            <input type="reset" class="btn btn-danger" value="重置">
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!--列表模板-->
        <div class="modal" tabindex="-1" role="dialog" id="modal_selectfile">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">请选择文件：（当前模板目录）</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="fileTree"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>



        <?import('/layout/bottom.php');?>
        <?function js(){?>

            <!-- 配置文件 -->
            <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.all.js"></script>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                    var ue = UE.getEditor('container',{autoHeightEnabled:false,initialFrameHeight:500});

            </script>

            <script src="/assets/plugin/fileTree/jquery.easing.js" type="text/javascript"></script>
            <script src="/assets/plugin/fileTree/jqueryFileTree.js" type="text/javascript"></script>
            <link href="/assets/plugin/fileTree/jqueryFileTree.css" rel="stylesheet" type="text/css" media="screen" />
            <style>
                #fileTree{
                    border: 1px solid #f5f5f5;
                    padding: 10px;
                    font-size: 16px !important;
                }
            </style>
            <script>

                $(document).ready(function () {

                    $('#select_template').on('click',function () {

                        $('#modal_selectfile').modal('show');

                        $('#fileTree').fileTree({
                            root: '/',
                            script: '<?=url('/admin/category/ajax_template_dir')?>'
                        }, function (file) {
                            $('#template').val(file.substr(0,file.length-4));
                            $('#modal_selectfile').modal('hide');
                        });

                    })


                })



            </script>

        <?}?>
