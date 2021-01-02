<?
use heephp\view;
view::create();
view::import('../layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">广告</h4>
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
                <a href="#">广告管理</a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">广告编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="ad_id" value="<?=$m['ad_id']?>">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control" name="title" placeholder="标题" value="<?=$m['title']?>">
                                </div>
                                <div class="form-group">
                                    <label for="link">链接</label>
                                    <input type="text" class="form-control" name="link" placeholder="链接" value="<?=$m['link']?>">
                                </div>
                                <div class="form-group">
                                    <label for="link">图片</label>
                                    <div class="row">
                                    <input type="text" class="form-control col-md-9" name="img" id="img" placeholder="排序" value="<?=$m['content']?>">
                                    <input type="button" class="btn btn-primary col-md-3" value="选择图片" onclick="selectpic()">
                                    </div>
                                    <div class="row">
                                        <a href="<?=$m['img']?>" id="priviewlink" target="_blank"><img src="<?=$m['img']?>" height="50" id="priview"> </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="remark">代码</label>
                                    <textarea type="text" class="form-control" name="code" placeholder="备注" >
                                        <?=$m['code']?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="link">点击量</label>
                                    <input type="text" class="form-control" name="hit" value="<?=$m['hit']?>" disabled readonly>
                                </div>
                            </div>
                        </div>

                        <p></p><p></p>
                        <div class="card-action">
                            <input type="submit" class="btn btn-success" value="提交">
                            <input type="reset" class="btn btn-danger" value="重置">
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    <span id="upload_ue"></span>
    <?
    view::import('/layout/bottom.php');

    ?>

    <?function js(){?>

        <!-- 配置文件 -->
        <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.all.js"></script>
        <!-- 实例化编辑器 -->
<script>
    //图片上传
    var _editor;

    //重新实例化一个编辑器，防止在上面的editor编辑器中显示上传的图片或者文件
    _editor = UE.getEditor('upload_ue');
    _editor.ready(function () {
        //设置编辑器不可用
        _editor.setDisabled();
        //隐藏编辑器，因为不会用到这个编辑器实例，所以要隐藏
        _editor.hide();
        //侦听图片上传
        _editor.addListener('beforeInsertImage', function (t, arg) {
            //将地址赋值给相应的input,只去第一张图片的路径
            console.log(arg)
            $('#img').val(arg[0].src);
            $('#priview').attr('src',arg[0].src);
            $('#priviewlink').attr('href',arg[0].src);
        });

    });

    function selectpic() {
        var myImage = _editor.getDialog("insertimage");
        myImage.open();
    }
    </script>

    <?}?>
