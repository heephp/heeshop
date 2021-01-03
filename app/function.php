<?php

use heephp\sysExcption;

function conf($name, $value=''){
    $db = db();
    //设置配置
    if(!empty($value)){
        return table('config')->where("`name`='$name'")->update(['value'=>$value])>0;
    }
    //获取配置
    $cachename = 'heecms_config';
    $all = cache($cachename);
    if(!$all){
        $all = $db->select('config','1=1');
        cache($cachename,$all);
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
 * 管理表格 表头标题
 * @param $field 当前字段
 * @param $curfield 排序的字段
 * @param $order
 * @param $title 标题
 * @return string 链接
 */
function mtitle($field,$curfield,$order,$title,$categoryid=''){
    $cls =$field==$curfield?" class='$order' ":'';

    $order=($order=='asc')?'desc':'asc';
    $url = url('manager',[$categoryid,$field,$order]);
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

function get_article($category_id,$top,$where='1=1',$recommend=1,$order='create_time desc'){
    $where=empty($where)?'1=1':$where;
    $mo = model('article');
    $mo->where($where.' and '.'category_id in('.$category_id.') and recommend in('.$recommend.')')->order($order)->limit($top)->select();
    $mo->category();
    $mo->create_user();
    return $mo->data;
}

function get_order_state($val){

        switch ($val){
            case -3:
                return '已完成退款';
                break;
            case -2:
                return '已确认退款';
                break;
            case -1:
                return '申请退款';
                break;
            case 0:
                return '未支付';
                break;
            case 1:
                return '已支付未发货';
                break;
            case 2:
                return '已发货未确认';
                break;
            case 3:
                return '已确认未评论';
                break;
            case 4:
                return '已完成';
                break;
        }

}