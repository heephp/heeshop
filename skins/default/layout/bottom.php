
<footer class="footer mt-30">
    <div class="container-fluid">
        <nav>友情链接：<?foreach ($friendlink as $f){?> <a href="<?=$f['url']?>" target="_blank"><?=$f['title']?></a> &nbsp; <?}?> </nav>
        <nav> <a href="#" target="_blank">关于我们</a> <span class="pipe">|</span> <a href="#" target="_blank">联系我们</a> <span class="pipe">|</span> <a href="#" target="_blank">法律声明</a>  <span class="pipe">|</span> <a href="#" target="_blank">帮助中心</a> </nav></nav>
        <p>Copyright &copy;2021 <?=conf('website_name')?> All Rights Reserved. <br>
            <a href="http://beian.miit.gov.cn/" target="_blank" rel="nofollow"><?=conf('website_icp')?></a><br>
        </p>
    </div>
</footer>
</div>
</body>
<script src="__res__/lib/jquery/1.9.1/jquery.js"></script>
<script src="__res__/js/Heeui.min.js"></script>
<script src="__res__/lib/jquery.SuperSlide/2.1.3/jquery.SuperSlide.js"></script>
<script src="__res__/js/default.js"></script>
<?php use heephp\view;
view::part('script');?>

</html>