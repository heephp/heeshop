<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">信息</h4>
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
                <a href="#"><?=$category_name?></a>
            </li>
            <li class="separator">
                <i class="flaticon-right-arrow"></i>
            </li>
            <li class="nav-item">
                <a href="#">信息编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('toolsbar.php',['category_id'=>$categoryid])?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="article_id" value="<?=$m['article_id']?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="parent_id">栏目</label>
                                    <select class="form-control" name="category_id">
                                        <option value="0">无</option>
                                        <?foreach ($plist as $p){?>
                                            <optgroup label="<?=$p['name']?>">
                                                <?foreach ($p['child'] as $c){?>
                                                <option value="<?=$c['category_id']?>" <?=($c['category_id']==$m['category_id']||$c['category_id']==$categoryid)?'selected':''?>><?=$c['name']?></option>
                                                <?}?>
                                            </optgroup>
                                        <?}?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="title">标题</label>
                                    <input type="text" class="form-control" name="title" placeholder="标题" value="<?=$m['title']?>">
                                </div>
                                <div class="form-group">
                                    <label for="remark">描述</label>
                                    <textarea type="text" class="form-control" name="remark" placeholder="描述" >
                                        <?=$m['remark']?>
                                    </textarea>
                                </div>


                                <div class="form-group">
                                    <label class="form-label">封面图</label>
                                    <div class="d-flex flex-wrap justify-content-start" id="first_pics">



                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="container">内容</label>
                                    <script id="container" name="context" type="text/plain">
                                        <?= html_entity_decode($m['context'])?>
                                    </script>
                                </div>
                                <div class="form-group">
                                    <label for="link">关键词</label>
                                    <select class="form-control select2input" name="keyword[]" multiple="multiple">
                                        <?$ks = explode(',',$m['keyword']);
                                        foreach ($ks as $k){?>
                                        <option value="<?=$k?>" selected><?=$k?></option>
                                        <?}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="link">作者</label>
                                    <input type="text" class="form-control" name="author" placeholder="作者" value="<?=$m['author']?>">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="sprice" onclick="$('.price').css('display',$('.price').css('display')=='none'?'block':'none');$('.price input').val('')"><label for="sprice">需要购买<span class="text-info">如果不需要购买，则不需要填写</span></label>
                                </div>
                                <div class="form-group price" style="display: none">
                                    <label for="link">价格</label>
                                    <input type="text" class="form-control" name="price" placeholder="价格" value="<?=$m['price']?>">
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
    <script>
        var first_pic="<?=$m['first_pic']?>";
    </script>
    <?
    import('/layout/bottom.php');

    function js(){?>
        <!-- 配置文件 -->
        <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/assets/plugin/ueditor/ueditor.all.js"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container',{autoHeightEnabled:false,initialFrameHeight:500});
            ue.addListener('contentChange',function(editor){
                $('#first_pics').html('');
                //相关操作
                var content = ue.getContent();
                var imgs = $(content).find('img');
                var html = '';
                imgs.each(function () {
                    var src=$(this).attr('src');
                    var title=$(this).attr('title');
                    var pichtml = $('#first_pic').html();
                    pichtml=pichtml.replace(/{img}/g,src);
                    pichtml=pichtml.replace(/{title}/g,title);
                    html+=pichtml;
                });
                $('#first_pics').html(html);
                set_first_pic(first_pic);
            });
            function set_first_pic(set_src) {
                $('#first_pics').find('input:checkbox').each(function () {
                    var src=$(this).val();
                    if(src==set_src){
                        $(this).prop("checked",true);
                        first_pic=set_src;
                    }else{
                        $(this).prop("checked",false);
                    }
                })
            }
        </script>
        <script type="text/html" id="first_pic">
            <div class="col-2 col-sm-2">
                <label class="imagecheck mb-2">
                    <input name="first_pic" type="checkbox" value="{img}" class="imagecheck-input" onclick="if($(this).prop('checked')){set_first_pic('{img}')}">
                    <figure class="imagecheck-figure">
                        <img src="{img}" alt="{title}" class="imagecheck-image" height="100">
                    </figure>
                </label>
            </div>
        </script>

    <?}?>
