<?import('/layout/header.php');?>
    <div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">信息管理</h4>
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
                <a href="#">信息编辑</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('toolsbar.php')?>
                <div class="card-body">
                    <?=$form?>
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

<?}?>