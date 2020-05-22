<? import('/layout/shop/header.php'); ?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">商品管理</h4>
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
                <a href="#">商品编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <form action="<?= url('save') ?>" method="post" onsubmit="return form_check();">

                <div class="card">
                    <? import('/layout/shop/toolsbar.php') ?>
                    <div class="card-body">

                        <ul class="nav nav-tabs nav-secondary" id="pills-tab" role="tablist">
                            <li class="nav-item submenu">
                                <a class="nav-link active show" id="pills-home-tab" data-toggle="pill"
                                   href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">基本</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link" id="pills-pic-tab" data-toggle="pill" href="#pills-pic" role="tab"
                                   aria-controls="pills-pic" aria-selected="true">图片</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link" id="pills-attr-tab" data-toggle="pill" href="#pills-attr" role="tab"
                                   aria-controls="pills-attr" aria-selected="true">属性</a>
                            </li>
                            <li class="nav-item submenu">
                                <a class="nav-link" id="pills-sku-tab" data-toggle="pill" href="#pills-sku" role="tab"
                                   aria-controls="pills-sku" aria-selected="true">SKU</a>
                            </li>
                        </ul>


                        <div class="tab-content mt-2 mb-3 row" id="pills-tabContent">
                            <div class="tab-pane fade show active col-md-10" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab">

                                <input type="hidden" name="shop_product_id" value="<?= $m['shop_product_id'] ?>">
                                <div class="form-group">
                                    <label for="parent_id">商品分类</label>
                                    <select class="form-control select2" name="shop_category_id" id="shop_category_id">
                                        <option value="0"></option>
                                        <? foreach ($plist as $p) { ?>
                                            <optgroup label="<?= $p['name'] ?>">
                                                <? foreach ($p['child'] as $c) { ?>
                                                    <option value="<?= $c['shop_category_id'] ?>" <?= $c['shop_category_id'] == $m['shop_category_id'] ? 'selected' : '' ?>><?= $c['name'] ?></option>
                                                <? } ?>
                                            </optgroup>
                                        <? } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">商品名称</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="商品名称"
                                           value="<?= $m['name'] ?>">
                                </div>
                                <div class="form-group d-flex flex-row">
                                    <style scope>
                                        label{
                                            align-self: flex-end;
                                        }
                                    </style>
                                    <label for="price">一口价：</label>
                                    <input type="text" class="form-control-sm col-md-2" name="price" id="price" value="<?=$m['price']?>">
                                    <label class="text-danger"> 元</label>
                                    <label for="price" class="ml-5">库存：</label>
                                    <input type="number" class="form-control-sm col-md-2" name="stock" id="stock" value="<?=$m['stock']?>">
                                </div>
                                <div class="form-group">
                                    <label for="link">简介</label>
                                    <textarea name="remark" class="form-control"
                                              id="remark"><?= $m['remark'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="link">详细介绍</label>
                                    <script id="detail" class="ueditor" name="detail" type="text/plain">
                                        <?= html_entity_decode($m['detail']) ?>

                                    </script>
                                </div>

                            </div>


                            <div class="tab-pane fade" id="pills-pic" role="tabpanel" aria-labelledby="pills-pic-tab">
                                <div id="upload_ue"></div>
                                <div class="form-group">
                                    <input type="button" class="btn btn-info btn-sm" value="上传图片" id="uploadimgs">
                                    <p></p>
                                    <label class="form-label">图片列表</label>
                                    <div class="d-flex flex-row flex-wrap" id="imglist">

                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="pills-attr" role="tabpanel" aria-labelledby="pills-attr-tab">
                            </div>


                            <div class="tab-pane fade" id="pills-sku" role="tabpanel" aria-labelledby="pills-sku-tab">
                            </div>


                        </div>


                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="提交">
                        <input type="reset" class="btn btn-info" value="重置">
                    </div>
                </div>
            </form>
        </div>
    </div>


    <? import('/layout/bottom.php'); ?>

    <? function js()
    { ?>

        <!-- 配置文件 -->
        <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.all.js"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">

            var ue;
            $(document).ready(function () {

                if($("#shop_category_id").val()!=''){
                    select_category($('#shop_category_id'));
                }

                $('.ueditor').each(function () {
                    ue = UE.getEditor($(this).attr('id'), {autoHeightEnabled: false, initialFrameHeight: 500});
                })

                $("#shop_category_id").on('select2:select', function () {
                    select_category(this);
                })

                //图片上传
                var _editor;
                var initimg = $("#product_img").html();
                var imgindex = 0;

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

                        var lasthtml = $("#imglist").html();
                        var srcs = '';

                        for (var i = 0; i < arg.length; i++) {
                            var htimg = initimg.replace(/{index}/g, i + imgindex);
                            htimg = htimg.replace(/{imgsrc}/g, arg[i].src);
                            lasthtml += htimg;
                            imgindex++;
                        }

                        $("#imglist").html(lasthtml);
                        $('#allpic').val(srcs);

                        selectimg($("input[name='pic_default']")[0]);
                    });

                });


                //图片上传按钮
                $('#uploadimgs').on('click', function () {
                    var myImage = _editor.getDialog("insertimage");
                    myImage.open();

                })
            });

            function select_category(e) {
                //读取SKU
                var url = '<?=url('ajax_skus','',false)?>/' + $(e).select2('val') + '?rnd=' + Math.random();
                $.get(url, function (result) {
                    $('#pills-sku').html(result);
                })
                //读取属性
                var url2 = '<?=url('ajax_attrs','',false)?>/' + $(e).select2('val') + '?rnd=' + Math.random();
                $.get(url2, function (result) {
                    $('#pills-attr').html(result);
                })
            }


            function closesrc(index) {
                $("div[data-index='" + index + "']").remove();
            }

            function selectimg(e) {
                $("#imglist").find('input:checkbox').each(function (value, index) {
                    $(this).prop('checked', false);
                })
                $(e).prop('checked', true);
            }

            $('#price').on('change', function () {
                var price = $('#price').val();
                if (price < 0) {
                    $('#price').val(0.01);
                    return;
                }
                if (!isNaN($('#price').val())) {
                    $('#price').val(parseFloat($(this).val()).toFixed(2));
                } else {
                    $('#price').val(0.01);
                }
            })


            function form_check() {

                var category_id = $('#shop_category_id').val();
                if (category_id == '' || category_id == 0) {
                    alert('请选择商品分类');
                    return false;
                }
                if ($.trim($('#name').val()) == '') {
                    alert('请填写商品名称');
                    return false;
                }
                if ($.trim($('#price').val()) == '') {
                    alert('请填写一口价');
                    return false;
                }
                var detail = ue.getContentTxt();
                if ($.trim(detail) == '') {
                    alert('请填写商品详细介绍');
                    return false;
                }

                if ($('#pics').length < 1) {
                    alert('请上传商品图片');
                    return false;
                }

                if ($('#pic_default').val() == '') {
                    alert('请选择默认商品图片');
                    return false;
                }
                return true;
            }



        </script>

        <script id="product_img" type="text/html">
            <div data-index="{index}" class="mr-md-1">
                <span style="float: right;cursor: pointer;" onclick="closesrc('{index}')">x</span><br>
                <label class="imagecheck mb-4">
                    <input onchange="selectimg(this)" name="pic_default" id="pic_default" type="checkbox"
                           value="{imgsrc}" class="imagecheck-input">
                    <figure class="imagecheck-figure">
                        <img src="{imgsrc}" class="imagecheck-image" width="150" height="150">
                    </figure>
                    <input type="hidden" name="pic[]" id="pics" value="{imgsrc}">
                </label>
            </div>
        </script>

    <? } ?>


