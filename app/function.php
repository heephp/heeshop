<?php
function conf($name,$value=''){
    $db = db();
    //设置配置
    if(!empty($value)){
        return $db->update('config',["`value`='$value'"],"`name`='$name'")>0;
    }
    //获取配置
    $all = cache(config('customer_config_name'));
    if(!$all){
        $all = $db->select('config','1=1');
        cache(config('customer_config_name'),$all);
    }
    foreach ($all as $row){
        if($row['name']==$name)
            return $row['value'];
    }
    return '';
}

/*
 * 从数组中读出指定键值 返回数组
 * */
function get_arr_val($arr,$key){
    $rearr = [];
    foreach ($arr as $k=>$v){
        if($k==$key)
            $rearr[]=$v;
    }
    return $rearr;
}

/**
 * 对传入的值进行编码
 */
function en($str){
    $b64 = base64_encode($str);
    $str =strtr($b64,'-abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_','cdlmuvwMnGHIJopDEFqrst2A3xyzBKL45+abfgCXW786hijkRVQ?NOPSTUYZ190e');
    return $str;
}

/**
 * 对传入值进行解码
 */
function de($str){
    $str =strtr($str,'cdlmuvwMnGHIJopDEFqrst2A3xyzBKL45+abfgCXW786hijkRVQ?NOPSTUYZ190e','-abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_');
    $str = base64_decode($str);
    return $str;
}