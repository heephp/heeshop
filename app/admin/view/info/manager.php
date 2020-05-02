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
                <a href="#">信息管理</a>
            </li>
        </ul>
    </div>


    <div class="row">
    <div class="col-md-12">
    <div class="card">
        <?import('toolsbar.php')?>
            <div class="card-body">
        <?=$table?>
            </div>
    </div>
    </div>
    </div>

<?import('/layout/bottom.php');?>
<?function js(){?>


<?}?>