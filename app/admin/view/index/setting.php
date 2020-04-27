<?import('/layout/header.php');?>
<div class="page-inner">
    <div class="page-header">
        <h4 class="page-title">设置</h4>
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
                <a href="#">系统设置</a>
            </li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-8">
                    <ul class="nav nav-pills nav-secondary  nav-pills-no-bd nav-pills-icons justify-content-center" id="pills-tab-with-icon" role="tablist">
                        <li class="nav-item submenu">
                            <a class="nav-link active show" id="pills-home-tab-icon" role="tab" aria-selected="false" aria-controls="pills-basic-icon" href="#pills-basic-icon" data-toggle="pill">
                                <i class="icon-settings"></i>
                                基本
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-profile-tab-icon" role="tab" aria-selected="false" aria-controls="pills-website-icon" href="#pills-website-icon" data-toggle="pill">
                                <i class="icon-screen-desktop"></i>
                                网站
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-contact-tab-icon" role="tab" aria-selected="true" aria-controls="pills-upload-icon" href="#pills-upload-icon" data-toggle="pill">
                                <i class="icon-arrow-up-circle"></i>
                                上传
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-contact-tab-icon" role="tab" aria-selected="true" aria-controls="pills-watermark-icon" href="#pills-watermark-icon" data-toggle="pill">
                                <i class="icon-picture"></i>
                                水印
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-contact-tab-icon" role="tab" aria-selected="true" aria-controls="pills-vcode-icon" href="#pills-vcode-icon" data-toggle="pill">
                                <i class="icon-social-stumbleupon"></i>
                                验证码
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-contact-tab-icon" role="tab" aria-selected="true" aria-controls="pills-mail-icon" href="#pills-mail-icon" data-toggle="pill">
                                <i class="icon-envelope-letter"></i>
                                邮件
                            </a>
                        </li>
                        <li class="nav-item submenu">
                            <a class="nav-link" id="pills-contact-tab-icon" role="tab" aria-selected="true" aria-controls="pills-sms-icon" href="#pills-sms-icon" data-toggle="pill">
                                <i class="icon-speech"></i>
                                短信
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?=url('save_setting')?>" method="post">
                    <div class="tab-content mt-2 mb-3" id="pills-with-icon-tabContent">
                        <?
                        import('setting/setting-basic.php');
                        import('setting/setting-website.php');
                        import('setting/setting-upload.php');
                        import('setting/setting-watermark.php');
                        import('setting/setting-vcode.php');
                        import('setting/setting-mail.php');
                        import('setting/setting-sms.php');
                        ?>
                    </div>
                    <div class="card-action">
                        <input type="submit" class="btn btn-success" value="提交">
                        <input type="reset" class="btn btn-danger" value="重置">
                    </div>
                    </form>
                </div>
        </div>
    </div>

    <?import('/layout/bottom.php');?>
    <?function js(){?>


    <?}?>
