<?
if(is_array($result)&&count($result)>0)
foreach ($result as $item){?>
<div class="form-group">
    <label for="link"><?=$item['name']?>：</label>
    <select type="text" class="form-control select2" name="attr_<?=$item['name']?>">
        <option value="">无</option>
        <?$list = explode(',',$item['values']);
        foreach ($list as $it){
            if(empty($it))continue;?>
            <option value="<?=$it?>" <?=isset($m)&&($item['name']==$m['shop_attr_name']&&$it==$m['value'])?'selected':''?>><?=$it?></option>
            <?}?>
    </select>
</div>
<?}?>
<script>
    $('.select2').select2();
</script>
