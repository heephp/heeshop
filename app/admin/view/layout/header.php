<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>HeeCMS v1.0</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--link rel="icon" href="/assets/img/icon.ico" type="image/x-icon"/-->

    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/assets/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/atlantis.min.css">
    <link rel="stylesheet" href="/assets/css/default.css">
    <link rel="stylesheet" href="/assets/css/select2.css">

</head>
<body>
<div class="wrapper static-sidebar">
    <div class="main-header">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">

            <a href="index.html" class="logo">
                <img src="/assets/img/logo.png" alt="HeeCMS" class="navbar-brand">
            </a>
            <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
            </button>
            <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="icon-menu"></i>
                </button>
            </div>
        </div>
        <!-- End Logo Header -->

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

            <div class="container-fluid">
                <div class="collapse" id="search-nav">
                    <form class="navbar-left navbar-form nav-search mr-md-3" method="get" action="<?=url('/index/search/')?>">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <button type="submit" class="btn btn-search pr-1">
                                    <i class="fa fa-search search-icon"></i>
                                </button>
                            </div>
                            <input type="text" placeholder="关键词" value="<?=$keyword?>" name="keyword" class="form-control">
                        </div>
                    </form>
                </div>
                <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                    <li class="nav-item toggle-nav-search hidden-caret">
                        <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                            <i class="fa fa-search"></i>
                        </a>
                    </li>

                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-envelope"></i>
                        </a>
                        <ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
                            <li>
                                <div class="dropdown-title d-flex justify-content-between align-items-center">
                                    消息
                                    <a href="#" class="small" onclick="markallread('<?=url('/message/markallread')?>')">标记所有为已读</a>
                                </div>
                            </li>
                            <li>
                                <div class="message-notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        <?
                                        if(count($message_list)>0){
                                        foreach ($message_list as $msg){?>
                                        <a href="<?=url('message/detail',$msg['message_id'])?>">
                                            <div class="notif-img">
                                                <img src="/assets/img/jm_denis.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="subject"><?=$msg['title']?></span>
                                                <span class="block">
														<?=sstr($msg['context'],10)?>
													</span>
                                                <span class="time"><?=transfer_time($msg['create_time'])?></span>
                                            </div>
                                        </a>
                                        <?}}?>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="see-all" href="<?=url('message/manager',[0,$msg['receiver_users_id']])?>">查看所有<i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown hidden-caret">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fas fa-layer-group"></i>
                        </a>
                        <div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
                            <div class="quick-actions-header">
                                <span class="title mb-1">快捷操作</span>
                                <span class="subtitle op-8">导航</span>
                            </div>
                            <div class="quick-actions-scroll scrollbar-outer">
                                <div class="quick-actions-items">
                                    <div class="row m-0">
                                        <a class="col-6 col-md-4 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-file-1"></i>
                                                <span class="text">添加用户</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-database"></i>
                                                <span class="text">添加用户组</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-pen"></i>
                                                <span class="text">发布文章</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-interface-1"></i>
                                                <span class="text">发信息</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-list"></i>
                                                <span class="text">菜单管理</span>
                                            </div>
                                        </a>
                                        <a class="col-6 col-md-4 p-0" href="#">
                                            <div class="quick-actions-item">
                                                <i class="flaticon-file"></i>
                                                <span class="text">资源管理</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown hidden-caret">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                            <div class="avatar-sm">
                                <img src="<?=(empty(request('session.admin_user_header'))?'/assets/img/profile.jpg':request('session.admin_user_header'))?>" alt="..." class="avatar-img rounded-circle">
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <div class="dropdown-user-scroll scrollbar-outer">
                                <li>
                                    <div class="user-box">
                                        <div class="avatar-lg"><img src="<?=(empty(request('session.admin_user_header'))?'/assets/img/profile.jpg':request('session.admin_user_header'))?>" alt="image profile" class="avatar-img rounded"></div>
                                        <div class="u-text">
                                            <h4><?=request('session.admin_user_name')?></h4>
                                            <p class="text-muted"><?=request('session.admin_user_email')?></p><a href="<?=url('users/edit',request('session.admin_user_id'))?>" class="btn btn-xs btn-secondary btn-sm">个人资料</a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?=url('message/manager',[0,request('session.admin_user_id')])?>">收件箱</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?=url('users/setting',request('session.admin_user_id'))?>">账户设置</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?=url('index/logout')?>">退出</a>
                                </li>
                            </div>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->
    </div>

    <div class="classic-grid">
        <!-- Sidebar -->
        <?import('sidebar.php')?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
