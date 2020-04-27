<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="<?=$c['website_name']?>" />
    <meta name="description" content=<?=$c['website_description']?>"">
    <meta name="keyword" content="<?=$c['website_keyword']?>" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <!-- Custom styles -->
    <link rel="stylesheet" href="/assets/css/style.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700|Roboto" rel="stylesheet">

    <!-- Ionic icons -->
    <link href="https://unpkg.com/ionicons@4.2.0/dist/css/ionicons.min.css" rel="stylesheet">

    <title><?=$c['website_name']?> <?=$c['website_keyword']?></title>

</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="http://www.heecms.cn" title="heecms 网站管理系统"><font color="#d3d3d3" size="+2"><b>ℋeeCMS</b></font></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="icon ion-md-menu"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">

                <? foreach($navlinks as $item){?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$item['url']?>" target="<?=$item['target']?>"><?=$item['title']?></a>
                    </li>
                <?}?>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
