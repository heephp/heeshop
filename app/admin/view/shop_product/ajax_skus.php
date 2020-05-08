<? var_dump($result);?>
    <div style="margin-left: 10px;">

        <table style="border: solid 1px #f5f5f5;">
        <style scoped>
        input{width:80px;}
        th,td{padding: 10px;}
        thead>tr{background: #f5f5f5;}
        tr:hover{background: #f5f5f5;}
        </style>
            <thead>
            <tr>
                <?foreach ($result['cls'] as $item){?>
            <th><?=$item['shop_sku_cls']?></th>
                <?}?>
            <th>市场价</th>
            <th>售价</th>
            <th>库存</th>
            </tr>
            <tr>
                <td colspan="<?=count($result['cls'])?>"><input type="button" value="一键填充" onclick="onechong()"> </td>
                <td><input type="number" id="sku_markprice"></td>
                <td><input type="number" id="sku_price"></td>
                <td><input type="number" id="sku_stock"></td>
            </tr>

            </thead>
            <tbody>
            <?foreach ($result['list'] as $it){
                $skustr='';
                $skustrval='';?>
                    <tr>
                        <?foreach ($result['cls'] as $item){?>
                            <th><?
                                $skuitem=$it['txt'.$item['shop_category_sku_id']];
                                echo $skuitem;
                                $skustr.=$skuitem.'|_|';
                                $skustrval.=$skuitem.',';
                            ?></th>
                        <?}
                        if(is_array($m)) {
                            $mi = array_filter($m, function ($val) use ($skustrval) {
                                return $val['shop_sku_cls'] == $skustrval;
                            });
                            if (count($mi) > 0) {
                                $mi = $mi[0];
                            }
                        }
                        ?>
                        <td><input type="number" name="sku_markprice_<?=$skustr?>" value="<?=$mi['markprice']??''?>"></td>
                        <td><input type="number" name="sku_price_<?=$skustr?>" value="<?=$mi['price']??''?>"></td>
                        <td><input type="number" name="sku_stock_<?=$skustr?>" value="<?=$mi['stock']??''?>"></td>
                    </tr>
            <?}?>
            </tbody>
        </table>
    </div>
    <script>
        function onechong() {alert('12')
            var sku_markprice=$('#sku_markprice').val();
            if(sku_markprice!=''){
                $("input[name^='sku_markprice_']").val(sku_markprice);
            }
            var sku_price=$('#sku_price').val();
            if(sku_price!=''){
                $("input[name^='sku_price_']").val(sku_price);
            }
            var sku_stock=$('#sku_stock').val();
            if(sku_stock!=''){
                $("input[name^='sku_stock_']").val(sku_stock);
            }
        }
    </script>
