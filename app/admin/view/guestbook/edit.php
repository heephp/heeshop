<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">留言</h4>
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
                <a href="#">留言查看</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <?import('/layout/toolsbar.php')?>
                <div class="card-body">

                    <blockquote>
                        <?=$m['context']?><br>
                        <small><?=$m['create_user']['name']?>发表于：<?=$m['create_time']?> 邮箱：<?=$m['email']?>微信：<?=$m['wx']?>QQ：<?=$m['qq']?> 手机:<?=$m['mobile']?> 联系人:<?=$m['contact']?></small>
                        <br><a href="javascript:void(0);" url="<?=url('delete',$m['guestbook_id'])?>" class="delete">删除</a>
                    </blockquote>

                </div>
            </div>
        </div>
    </div>

    <?import('/layout/bottom.php');?>

    <?function js(){?>


    <?}
    ?>
    <style>
        blockquote{
            margin-left: 15px;
            padding: 15px;
            border-left: solid 5px #FFF6D9;
        }
    </style>
