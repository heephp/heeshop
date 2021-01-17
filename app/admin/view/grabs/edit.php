<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">栏目</h4>
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
                <a href="#">采集编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <form action="<?=url('save')?>" method="post">

                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">基本</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="adv-tab" data-toggle="tab" href="#adv" role="tab" aria-controls="adv" aria-selected="false">详细</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active mt-2" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="tab-pane fade  show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                    <input type="hidden" name="grabs_id" value="<?=$m['grabs_id']?>">
                                    <div class="row">
                                        <div class="col-lg-6">

                                            <div class="form-group">
                                                <label for="title">任务名称</label>
                                                <input type="text" class="form-control" name="name" placeholder="名称" value="<?=$m['name']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="parent_id">栏目</label>
                                                <select class="form-control select2" name="category_id">
                                                    <option value="0">无</option>
                                                    <?foreach ($plist as $p){?>
                                                        <option value="<?=$p['category_id']?>" <?=$p['category_id']==$m['category_id']?'selected':''?>><?=$p['name']?></option>
                                                    <?}?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">网址</label>
                                                <input type="text" class="form-control" name="url" placeholder="网址" value="<?=$m['url']?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="remark">备注</label>
                                                <textarea type="text" class="form-control" name="desc" placeholder="备注" >
                                                    <?=$m['desc']?>
                                                </textarea>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="tab-pane fade" id="adv" role="tabpanel" aria-labelledby="adv-tab">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label for="title">每次采集详细页数量</label>
                                            <input type="text" class="form-control" name="epage" placeholder="每次采集详细页数量" value="<?=$m['epage']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">详细页链接前缀</label>
                                            <input type="text" class="form-control" name="baseurl" placeholder="详细页链接前缀" value="<?=$m['baseurl']?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">采集网址</label>
                                            <input type="text" class="form-control" name="urls" placeholder="采集网址" value="<?=$m['urls']?>">[p]为分页变量
                                        </div>
                                        <div class="form-group">
                                            <label for="title">开始/结束页</label>
                                            <input type="text" name="startpage" placeholder="开始" value="<?=$m['startpage']?>">-<input type="text" name="endpage" placeholder="结束" value="<?=$m['endpage']?>">页
                                        </div>
                                        <div class="form-group">
                                            <label for="linkstart">链接区域开始</label>
                                            <textarea type="text" class="form-control" name="linkstart" placeholder="链接区域开始" ><?=$m['linkstart']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="linkend">链接区域结束</label>
                                            <textarea type="text" class="form-control" name="linkend" placeholder="链接区域结束" ><?=$m['linkend']?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="filterlinks">要过滤的链接</label>
                                            <textarea type="text" class="form-control" name="filterlinks" placeholder="要过滤的链接" ><?=$m['filterlinks']?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="titlestart">标题开始</label>
                                    <textarea type="text" class="form-control" name="titlestart" placeholder="标题开始" ><?=$m['titlestart']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="titleend">标题结束</label>
                                    <textarea type="text" class="form-control" name="titleend" placeholder="标题结束" ><?=$m['titleend']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="authorstart">作者开始</label>
                                    <textarea type="text" class="form-control" name="authorstart" placeholder="作者开始" ><?=$m['authorstart']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="authorend">作者结束</label>
                                    <textarea type="text" class="form-control" name="authorend" placeholder="作者结束" ><?=$m['authorend']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="timestart">发布时间开始</label>
                                    <textarea type="text" class="form-control" name="timestart" placeholder="发布时间开始" ><?=$m['timestart']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="timeend">发布时间结束</label>
                                    <textarea type="text" class="form-control" name="timeend" placeholder="发布时间结束" ><?=$m['timeend']?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="contentstart">内容开始</label>
                                    <textarea type="text" class="form-control" name="contentstart" placeholder="内容开始" ><?=$m['contentstart']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="contentend">内容结束</label>
                                    <textarea type="text" class="form-control" name="contentend" placeholder="内容结束" ><?=$m['contentend']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="filterhtml">允许的内容HTML标签</label>
                                    <input type="text"  class="form-control" name="filterhtml" placeholder="要过滤的内容HTML标签 p span pre ..." value="<?=$m['filterhtml']??'img p span pre'?>">
                                    <span class="text-muted">允许的内容HTML标签 p span pre ... 空格分隔</span>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-success" value="提交">
                        <input type="reset" class="btn btn-danger" value="重置">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?
    import('/layout/bottom.php');
    import('/share/icon/select.php');

    ?>

    <?function js(){
        import('/moban/template_select.php');?>

        <script src="/assets/plugin/fileTree/jquery.easing.js" type="text/javascript"></script>

    <?}?>
