
<!-- Footer -->
<section id="footer">
    <div class="container">
        <div class="heading-wrapper">
            <h3>准备好使用HeeCMS了吗？</h3>
            <p>新的网站使用上HeeCMS，接下来就会一直想用HeeCMS，因为好用、实用、美观、关键是还会一直更新</p>
            <a href="http://www.github.com/heephp/heecms" class="primary-btn">现在就下载</a>
        </div>
        <div class="row topmargin-lg">
            <div class="col-md-12">
                友情链接：
                <?foreach ($friendlink as $link){?>
                    <a href="<?=$link['url']?>" target="_blank"><?=$link['title']?></a>
                <?}?>
                <br>
                <small>© 版权所有 2020 上海绿松信息技术有限公司 <?=$c['website_icp']?></small>
            </div>

        </div>
    </div>
</section>
<!-- End Footer -->


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
</body>

</html>