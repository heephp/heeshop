<?import('/layout/header.php')?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">数据表</h4>
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
                <a href="#">数据表管理</a>
            </li>
        </ul>
    </div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <?import('/layout/toolsbar.php')?>
            <div class="card-body">
<?=$form?>
            </div>
        </div>
    </div>
</div>
<?import('/layout/bottom.php')?>
<?function js(){?>
    <script>
            var row = $('.form-row')[1];

            function addfield() {
                $('#addfield').append(row.outerHTML);
                $('#addfield').find('.form-row:last').find('input').each(function () {
                    $(this).val('');
                })
                $('#addfield').find('.form-row:last').find('select').each(function () {
                    $(this).val('');
                })
            }


    </script>
<?}?>
