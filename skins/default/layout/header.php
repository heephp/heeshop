<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" contect="<?=$c['website_keyword']?>">
    <meta name="description" contect="<?=$c['website_description']?>">
    <meta name="Author" contect="heecms 上海绿松信息技术有限公司">

    <title><?=$c['website_name']?> <?=$c['website_keyword']?></title>

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="__res__css/bootstrap.min.css" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="__res__css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="__res__css/style.css" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>
<!-- HEADER -->
<header id="header">
    <!-- NAV -->
    <div id="nav">
        <!-- Top Nav -->
        <div id="nav-top">
            <div class="container">
                <!-- social -->
                <ul class="nav-social">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                </ul>
                <!-- /social -->

                <!-- logo -->
                <div class="nav-logo">
                    <a href="index.html" class="logo"><img src="<?=$c['website_logo']?>" alt=""></a>
                </div>
                <!-- /logo -->

                <!-- search & aside toggle -->
                <div class="nav-btns">
                    <button class="aside-btn"><i class="fa fa-bars"></i></button>
                    <button class="search-btn"><i class="fa fa-search"></i></button>
                    <div id="nav-search">
                        <form>
                            <input class="input" name="search" placeholder="Enter your search...">
                        </form>
                        <button class="nav-close search-close">
                            <span></span>
                        </button>
                    </div>
                </div>
                <!-- /search & aside toggle -->
            </div>
        </div>
        <!-- /Top Nav -->

        <!-- Main Nav -->
        <div id="nav-bottom">
            <div class="container">
                <!-- nav -->
                <ul class="nav-menu">
                    <?foreach ($navlinks as $item){
                        if(!empty($item['child'])){?>
                    <li class="has-dropdown">
                        <a href="<?=url($item['url'])?>"><?=$item['title']?></a>
                        <div class="dropdown">
                            <div class="dropdown-body">
                                <ul class="dropdown-list">
                                    <?foreach ($item['child'] as $c){?>
                                    <li><a href="<?=url($item['url'])?>"><?=$c['title']?></a></li>
                                    <?}?>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <?}else{?>
                    <li><a href="<?=url($item['url'])?>" target="<?=$item['target']?>"><?=$item['title']?></a></li>
                    <?}}?>
                </ul>
                <!-- /nav -->
            </div>
        </div>
        <!-- /Main Nav -->

        <!-- Aside Nav -->
        <div id="nav-aside">
            <ul class="nav-aside-menu">
                <?foreach ($navlinks as $item){
                if(!empty($item['child'])){?>
                <li class="has-dropdown"><a><?=$item['title']?></a>
                    <ul class="dropdown">
                        <?foreach ($item['child'] as $c){?>
                            <li><a href="<?=url($item['url'])?>"><?=$c['title']?></a></li>
                        <?}?>
                    </ul>
                </li>
                <?}else{?>
                    <li><a href="<?=url($item['url'])?>" target="<?=$item['target']?>"><?=$item['title']?></a></li>
                <?}}?>
            </ul>
            <button class="nav-close nav-aside-close"><span></span></button>
        </div>
        <!-- /Aside Nav -->
    </div>
    <!-- /NAV -->
</header>
<!-- /HEADER -->