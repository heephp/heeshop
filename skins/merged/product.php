<?import('/layout/header.php');?>
<div class="banner1">
</div>
<!-- //banner -->
<!-- gallery -->
<section class="banner-bottom gallery">
    <div class="container">
        <div class="wthree_head_section">
            <h2 class="w3l_header">产品列表</h2>
            <p>Our team provides consulting services focusing on the most critical business issues.</p>
        </div>
        <? for($i=0;$i<count($list);$i=$i+3){?>

        <div class="row w3ls_gallery_grids">
            <? for($k=0;$k<3;$k++){
            $item = $list[$i+$k];?>
            <div class="col-md-4 w3_agile_gallery_grid">

                <div class="agile_gallery_grid">
                    <a title="<?=$item['name']?>" target="_blank" href="<?=$item['pic']?>">
                        <div class="agile_gallery_grid1">
                            <img src="<?=$item['pic']?>" alt="<?=$item['name']?>" class="img-responsive" />
                            <div class="w3layouts_gallery_grid1_pos">
                                <h3><?=$item['name']?></h3>
                                <p>￥<?=$item['price']?>元</p>
                            </div>
                        </div>
                    </a>
                </div>

            </div>
            <?}?>
        </div>
        <?}?>
    </div>
</section>
<!-- //gallery -->
<?import('/layout/footer.php');?>
