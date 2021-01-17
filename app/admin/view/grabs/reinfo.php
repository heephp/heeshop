<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>采集跳转提示</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta http-equiv="refresh" content="<?=conf('grabs_invtime')?>;url=<?=$url?>">

    <style>
        body{padding: 20px 30px;margin: 20px 20px;}
    </style>
</head>
<body>

<?=$msg?>

<div>
    长时间没有跳转？<a href="<?=$url?>"> 点击链接</a>
</div>


</body>
</html>