<!DOCTYPE html>
<html lang="zxx">
<head>
    <title><?=$title?>_<?=$c['website_name']?></title>
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="<?=$c['website_keyword']?>" />
    <meta name="description" content="<?=$c['website_description']?>" />

    <script type="application/x-javascript">
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- // Meta Tags -->
    <!-- Testimonials-slider-css-files -->
    <link rel="stylesheet" href="__res__css/owl.carousel.css" type="text/css" media="all">
    <link href="__res__css/owl.theme.css" rel="stylesheet">
    <!-- //Testimonials-slider-css-files -->

    <!--booststrap-->
    <link href="__res__css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <!--//booststrap end-->
    <!-- font-awesome icons -->
    <link href="__res__css/fontawesome-all.css" rel="stylesheet">
    <!-- //font-awesome icons -->
    <!--stylesheets-->
    <link rel="stylesheet" href="__res__css/flexslider.css" type="text/css" media="screen" />
    <!--stylesheets-->
    <link href="__res__css/contact.css" rel="stylesheet" type='text/css' media="all" />
    <link href="__res__css/style.css" rel='stylesheet' type='text/css' media="all">
</head>
<body>
<header>
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 top-middle">
                    <ul>
                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-google-plus-g"></i></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin-in"></i></i></a></li>
                    </ul>
                </div>
                <div class="col-sm-6 top-left">
                    <ul>
                        <li><i class="fas fa-phone"></i> <?=$c['company_tel']?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bar">
        <div class="container">
            <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="hedder-up">
                    <h1><a class="navbar-brand" href="index.html">H<span>eeCMS</span></a></h1>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav">
                        <?foreach ($navlinks as $item){
                        if(!empty($item['child'])){?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="<?=url($item['url'])?>" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <?=$item['title']?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?foreach ($item['child'] as $c){?>
                                <a class="dropdown-item" href="<?=url($item['url'])?>"><?=$c['title']?></a>
                                <div class="dropdown-divider"></div>
                            <?}?>
                            </div>
                        </li>
                        <?}else{?>
                            <li class="nav-item"><a class="nav-link" href="<?=url($item['url'])?>" target="<?=$item['target']?>"><?=$item['title']?></a></li>

                        <?}}?>
                    </ul>
                </div>
            </nav>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //Navigation -->
</header>
