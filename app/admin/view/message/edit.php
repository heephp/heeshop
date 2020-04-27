<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">消息</h4>
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
                <a href="#">用户消息发送/编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">
                    <form action="<?=url('save')?>" method="post">
                        <input type="hidden" name="message_id" value="<?=$m['message_id']?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="receiver">收件人</label>
                                <input type="text" class="form-control" <?=empty($m['message_id'])?"":"readonly";?> name="receiver" value="<?=$m['receiver']['username']?>">
                                <small>发送给所有人的消息填写:all</small>
                            </div>
                            <div class="form-group">
                                <label for="title">标题</label>
                                <input type="text" class="form-control" name="title" placeholder="标题" value="<?=$m['title']?>">
                            </div>
                            <div class="form-group">
                                <label for="context">内容</label>
                                <textarea type="text" class="form-control" name="context" placeholder="内容" >
                                        <?=$m['context']?>
                                </textarea>
                            </div>

                    <p></p><p></p>
                    <div class="card-action">
                        <input type="submit" class="btn btn-success" value="发送">
                        <input type="reset" class="btn btn-danger" value="重置">
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>

    <?import('/layout/bottom.php');?>
    <?function js(){?>


    <?}?>
