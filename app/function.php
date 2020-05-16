<?php

use heephp\sysExcption;

function conf($name, $value=''){
    $db = db();
    //设置配置
    if(!empty($value)){
        return table('config')->where("`name`='$name'")->update(['value'=>$value])>0;
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

function modeluser($name)
{
    //取出用户模型表前缀
    $user_model_pre = config('user_model_prefix');
    //从数据表中取出验证规则
    $mt = model('model_table')->where("`name`='$name'")->find();
    if (!$mt) {
        throw new sysExcption('自定义模型表名：' . $name . '不存在！');
        return;
    }
    $validate_rule = $mt['validate_rule'];
    $validate_msg = $mt['validate_msg'];
    $model = model($user_model_pre . $name);
    $model->softdel = true;
    $model->autotimespan = true;
    $model->validate_rule = $validate_rule;
    $model->validate_msg = $validate_msg;
    return $model;
}

/**
 * 管理表格 表头标题
 * @param $field 当前字段
 * @param $curfield 排序的字段
 * @param $order
 * @param $title 标题
 * @return string 链接
 */
function mtitle($field,$curfield,$order,$title){
    $cls =$field==$curfield?" class='$order' ":'';

    $order=($order=='asc')?'desc':'asc';
    $url = url('manager',[$field,$order]);
    return "<a href='$url' $cls>$title</a>";
}

function getcurl($url){
    $curl = curl_init();
    curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($curl,CURLOPT_URL, $url);
    curl_setopt($curl,CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}
