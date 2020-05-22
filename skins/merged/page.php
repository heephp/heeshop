<?import('/layout/header.php',['title'=>$m['title']])?>
<div class="banner1">
</div>

<div class="typo">
    <div class="container">
        <div class="wthree_head_section">
            <h2 class="w3l_header"><?=$m['title']?> </h2>
            <p><?=$m['description']?></p>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?=html_entity_decode($m['body'])?>
            </div>
        </div>
    </div>
</div>
<?import('/layout/footer.php')?>
