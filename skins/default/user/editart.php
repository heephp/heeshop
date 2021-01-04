<?php
use heephp\view;
view::create();
view::import('uclayout',['title'=>'发布信息']);
function view_content(){
$m=view::getvar('m');
?>

    <form action="<?=url('saveart')?>" method="post">
        <input type="hidden" name="article_id" value="<?=$m['article_id']?>">

                <div class="row cl">
                    <div class="col-xs-12 col-md-10 col-md-offset-1">
                        <div class="row cl mt-20">
                            <label class="col-xs-12 col-md-1" for="parent_id">栏目</label>
                            <div class="col-xs-12 col-md-6"> <select class="select" name="category_id">
                                <option value="0">无</option>
                                <?foreach (view::getvar('plist') as $p){?>
                                    <optgroup label="<?=$p['name']?>">
                                        <?foreach ($p['child'] as $c){?>
                                            <option value="<?=$c['category_id']?>" <?=($c['category_id']==$m['category_id']||$c['category_id']==$categoryid)?'selected':''?>><?=$c['name']?></option>
                                        <?}?>
                                    </optgroup>
                                <?}?>
                                </select></div>
                        </div>

                        <div class="row cl mt-20">
                            <label class="col-xs-12 col-md-1" for="title">标题</label>
                            <div class="col-xs-12 col-md-9"><input type="text" class="input-text" name="title" placeholder="标题" value="<?=$m['title']?>"></div>
                        </div>
                        <div class="row cl mt-20">
                            <label class="col-xs-12 col-md-1" for="remark">描述</label>
                            <div class="col-xs-12 col-md-9"><textarea type="text" class="textarea" name="remark" placeholder="描述" >
                                                <?=$m['remark']?>
                                </textarea></div>
                        </div>


                        <div class="row cl mt-20">
                            <label class="col-xs-12 col-md-1" class="form-label">封面</label>
                            <div class="d-flex flex-wrap justify-content-start" id="first_pics">



                            </div>
                        </div>


                        <div class="row cl mt-20">
                            <label class="col-xs-12 col-md-1" for="container">内容</label>
                            <div class="col-xs-12 col-md-11">
                            <script id="container" name="context" type="text/plain">
                                                <?= html_entity_decode($m['context'])?>
                                            </script>
                            </div>
                        </div>
                        <div class="row cl mt-20">
                            <label class="col-xs-12 col-md-2" for="link">关键词</label>
                            <div class="col-xs-12 col-md-8">
                                <input type="text" class="input-text" name="keyword" placeholder="标题" value="<?=$m['keyword']?>">
                                <small>多个关键词使用,分隔</small>
                            </div>
                        </div>

                    </div>
                </div>


        <p></p>
        <div class="card-action col-offset-2">
            <input type="hidden" name="crsf" value="<?=crsf()?>">
            <input type="submit" class="btn btn-success" value="提交">
            <input type="reset" class="btn btn-danger" value="重置">
        </div>

        </div>
    </form>

<?php
}
function view_script(){
    $m=view::getvar('m');
    ?>
<!-- 配置文件 -->
<script type="text/javascript" src="/assets/plugin/ueditor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="/assets/plugin/ueditor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
    <script type="text/javascript">
        var first_pic="<?=view::getvar('m')['first_pic']?>";
        $(function () {

            var ue = UE.getEditor('container', {autoHeightEnabled: false, initialFrameHeight: 500});
            ue.addListener('contentChange', function (editor) {
                $('#first_pics').html('');
                //相关操作
                var content = ue.getContent();
                var imgs = $(content).find('img');
                var html = '';
                imgs.each(function () {
                    var src = $(this).attr('src');
                    var title = $(this).attr('title');
                    var pichtml = $('#first_pic').html();
                    pichtml = pichtml.replace(/{img}/g, src);
                    pichtml = pichtml.replace(/{title}/g, title);
                    html += pichtml;
                });
                $('#first_pics').html(html);
                set_first_pic(first_pic);
            });
        })
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
        <div class="col-md-2 col-sm-2">
            <label class="imagecheck mb-2">
                <input name="first_pic" type="checkbox" value="{img}" class="imagecheck-input" onclick="if($(this).prop('checked')){set_first_pic('{img}')}">
                <figure class="imagecheck-figure">
                    <img src="{img}" alt="{title}" class="imagecheck-image" height="100">
                </figure>
            </label>
        </div>
    </script>
<?php }?>