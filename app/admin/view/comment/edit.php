<?import('/layout/header.php');?>
    <div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">评论</h4>
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
                <a href="#">评论编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php',['hasnew'=>false])?>
                <div class="card-body">

                    <blockquote>
                        <small><b><?=$m['title']?></b></small><br>
                        <?=$m['context']?><br>
                        <small><?=$m['create_user']['name']?>发表于：<?=$m['create_time']?> 邮箱：<?=$m['email']?> 手机:<?=$m['mobile']?> 联系人:<?=$m['contact']?></small>
                        <br><a href="javascript:void(0);" url="<?=url('delete',$m['comment_id'])?>" class="delete">删除</a>
                    </blockquote>

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
            $('.ueditor').each(function() {
              var ue = UE.getEditor($(this).attr('id'),{autoHeightEnabled:false,initialFrameHeight:500});
            })

        </script>

<?}
?>
        <style>
            blockquote{
                margin-left: 15px;
                padding: 15px;
                border-left: solid 5px #FFF6D9;
            }
            </style>
