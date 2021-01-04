<?php
use heephp\view;
view::create();
view::import('../layout/header');
?>

<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">模板</h4>
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
                <a href="#">在线模板</a>
            </li>

        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <iframe src="" width="100%" height="600px" frameborder="0">

                </iframe>
                </div>
            </div>
        </div>

<?view::import('../layout/bottom');?>
<?function js(){?>


<?}?>