<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta type="keyword" content="<?=$kw?>">
    <meta type="description" content="<?=$desc?>">
    <title><?=$title?> <?=conf('website_name')?> 好用网站管理系统</title>
    <link rel="stylesheet" href="__res__/css/Heeui.css">
    <link rel="stylesheet" href="__res__/css/reset.css">
    <link rel="stylesheet" href="__res__/lib/Heeiconfont/1.0.8/iconfont.css">
    <link rel="stylesheet" href="__res__/css/default.css">

</head>
<body>
<div class="container">

    <div class="topnav">
        <div class="wp cl pl-10 pr-10">
            <div class="l">您好，欢迎使用HeeCMS 好用网站管理系统</div>
            <div class="r">
                <?if(!$islogin){?>
                    <span class="r_nav">[ <a rel="nofollow" href="<?=url('user/login')?>">登录</a> ]</span>
                    <span class="pipe">|</span><span class="r_nav">[ <a href="<?=url('user/reg')?>" rel="nofollow">注册</a> ]</span>
                <?}else{?>
                    <span class="r_nav"> 欢迎：<?=request('session.user_name')?>[ <a rel="nofollow" href="<?=url('user/usercenter')?>">用户中心</a> ]</span>
                    <span class="pipe">|</span><span class="r_nav">[ <a href="<?=url('user/logout')?>" rel="nofollow">退出</a> ]</span>
                <?}?>
            </div>

        </div>
    </div>
    <div class="row cl" style="height: 80px;padding: 10px">
        <div class="col-xs-12 col-md-3" align="center"><div class="radius" style="width: 220px; height: 80px;line-height:80px;background: #fff;font-size: 32px;color: #003366;font-style: italic;">HeeCMS </div></div>
        <div class="col-lg-9 hidden-md hidden-xs hidden-sm">
            <?$adb1 = get_ad('banner');?>
            <a href="<?=url($adb1['link'])?>" target="_blank"><img src="<?=$adb1['img']?>" height="80" width="900"/></a></div>
    </div>

    <nav class="nav navbar-nav nav-collapse mt-20" role="navigation" id="Hui-navbar" style="background: #006699;">
        <ul class="cl">
            <?php foreach ($navlinks as $item){
                list($cu,$ext)=explode('.',$_SERVER['REQUEST_URI']);
                if(!empty($item['child'])){?>
                    <li class="dropDown dropDown_hover"><a href="#" class="dropDown_A"><?=$item['title']?><i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <?php foreach ($item['child'] as $ci){?>
                                <li <?if($cu==$ci['url']){echo 'class="current"';}?>><a href="<?=url($ci['url'])?>" target="<?=url($ci['target'])?>"><?=$ci['title']?></a></li>
                            <? }?>
                        </ul>
                    </li>
                    <?}else{?>
                    <li <?if($cu==$item['url']){echo 'class="current"';}?>><a href="<?=url($item['url'])?>" target="<?=url($ci['target'])?>"><?=$item['title']?></a></li>
                    <?}?>
            <?}?>
        </ul>
    </nav>