<!-- footer -->
<footer>
    <section class="footer">
        <div class="container">
            <div class="row f-bg-w3l">
                <div class="col-md-6 w3layouts_footer_grid fokt">
                    <h3>直接反馈信息给我们</h3>
                    <p>我们提供了随时反馈信息的渠道，输入您的需求，直接发消息给我们，以便能给您个性化的服务</p>
                    <form action="#" method="post">
                        <input type="text" name="msg" placeholder="输入您的需求，以提供满足您的服务" required="">
                        <button class="btn1"><i class="far fa-envelope"></i></button>
                        <div class="clearfix"> </div>
                    </form>


                </div>

                <div class="col-md-2 w3layouts_footer_grid">
                    <h3>常用链接</h3>
                    <ul class="links">
                        <?foreach ($footnav as $item){?>
                        <li><a href="<?=$item['title']?>" target="<?=$item['target']?>"><?=$item['title']?></a></li>
                        <?}?>
                    </ul>
                </div>
                <div class="col-md-4 w3layouts_footer_grid">
                    <h2>联系我们</h2>
                    <ul class="con_inner_text">
                        <li><span class="fa fa-map-marker" aria-hidden="true"></span><?=$c['company_addr']?></li>
                        <li><span class="fa fa-envelope" aria-hidden="true"></span> <a href="mailto:<?=$c['company_email']?>"><?=$c['company_email']?></a></li>
                        <li><span class="fa fa-phone" aria-hidden="true"></span> <?=$c['company_tel']?></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- //footer -->
    <p class="copyright">© 2020 <?=$c['company_name']?>. All Rights Reserved | Design by <a href="https://www.heecms.cn/" target="_blank">HeeCMS</a> <?=$c['website_pic']?></p>
</footer>
<!-- modal -->
<div class="modal about-modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Merged</h4>
            </div>
            <div class="modal-body">
                <div class="agileits-w3layouts-info">
                    <img src="__res__images/about.jpg" class="img-responsive" alt="" />
                    <p>Duis venenatis, turpis eu bibendum porttitor, sapien quam ultricies tellus, ac rhoncus risus odio eget nunc. Pellentesque ac fermentum diam. Integer eu facilisis nunc, a iaculis felis. Pellentesque pellentesque tempor enim, in dapibus turpis porttitor quis. Suspendisse ultrices hendrerit massa. Nam id metus id tellus ultrices ullamcorper.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- //modal -->

<!--js working-->
<script type="text/javascript" src="__res__js/jquery-2.2.3.min.js"></script>
<!--//js working-->
<!--Start-slider-script-->
<script defer src="__res__js/jquery.flexslider.js"></script>
<script type="text/javascript">

    $(window).load(function(){
        $('.flexslider').flexslider({
            animation: "slide",
            start: function(slider){
                $('body').removeClass('loading');
            }
        });
    });
</script>
<!--End-slider-script-->
<!-- stats -->
<script src="__res__js/jquery.waypoints.min.js"></script>
<script src="__res__js/jquery.countup.js"></script>
<script>
    $('.counter').countUp();
</script>
<!-- //stats -->
<!-- for testimonials slider-js-file-->
<script src="__res__js/owl.carousel.js"></script>
<!-- //for testimonials slider-js-file-->
<script>
    $(document).ready(function() {
        $("#owl-demo").owlCarousel({

            autoPlay: 3000, //Set AutoPlay to 3 seconds
            autoPlay:true,
            items : 3,
            itemsDesktop : [640,5],
            itemsDesktopSmall : [414,4]
        });
    });
</script>
<!-- for testimonials slider-js-script-->
<!-- smooth scrolling -->
<script type="text/javascript" src="__res__js/move-top.js"></script>
<script type="text/javascript" src="__res__js/easing.js"></script>
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({ easingType: 'easeOutQuart' });

    });
</script>
<!-- //here ends scrolling icon -->
<!-- //smooth scrolling -->
<!-- scrolling script -->
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>
<!-- //scrolling script -->

<!--bootstrap working-->
<script src="__res__js/bootstrap.min.js"></script>
<!-- //bootstrap working-->
</body>
</html>