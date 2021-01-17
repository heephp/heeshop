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

function getcurl($url,$host=''){
    $oCurl = curl_init();
    // 设置请求头, 有时候需要,有时候不用,看请求网址是否有对应的要求
    $header[] = empty($header)?"Content-type: application/x-www-form-urlencoded":$header;
    $user_agent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36";
    curl_setopt($oCurl, CURLOPT_URL, $url);
    curl_setopt($oCurl, CURLOPT_HTTPHEADER,$header);
    // 返回 response_header, 该选项非常重要,如果不为 true, 只会获得响应的正文s
    curl_setopt($oCurl, CURLOPT_HEADER, true);
    // 是否不需要响应的正文,为了节省带宽及时间,在只需要响应头的情况下可以不要正文
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($oCurl, CURLOPT_NOBODY, false);
    // 使用上面定义的 ua
    curl_setopt($oCurl, CURLOPT_USERAGENT,$user_agent);
    curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );

    // 不用 POST 方式请求, 意思就是通过 GET 请求
    curl_setopt($oCurl, CURLOPT_POST, false);

    $sContent = curl_exec($oCurl);

    $headerSize = curl_getinfo($oCurl, CURLINFO_HEADER_SIZE);
    // 根据头大小去获取头信息内容
    $header = substr($sContent, 0, $headerSize);
    $hs = explode("\n",$header);
    $headall=[];
    //var_dump($hs);
    foreach ($hs as $h){
        if(strrpos($h,':')){
            $headall[]= $h;
        }
    }

    return ['header'=>$headall,'body'=>substr($sContent,$headerSize)];
}

function get_article($category_id,$top,$where='1=1',$recommend=1,$order='create_time desc'){
    $where=empty($where)?'1=1':$where;
    $mo = model('article');
    $mo->where($where.' and '.'category_id in('.$category_id.') and recommend in('.$recommend.')')->order($order)->limit($top)->select();
    $mo->category();
    $mo->create_user();
    return $mo->data;
}

function get_ad($group,$num=1)
{
    //读取广告
    $ad = model("ad");
    $ad->field("ad_id,`group`,img,ord,CONCAT('/".APP."/ad/to/',ad_id) link")->where("`group`='$group'")->order('ord asc,RAND()')->limit($num);
    if($num==1)
        $adlist = $ad->get();
    else
        $adlist = $ad->all();
    return $adlist;
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


/**返回用户是否已经购买某个栏目、信息、页面
 * @param $users_id 用户ID
 * @param $type category pages article
 * @param $tid 相关表id
 * @param bool $isservice 服务商品默认需要检测服务时长 实物商品无需检测
 */
function get_ispay($users_id,$type,$tid,$isservice=true){
    $minfo = model($type)->get($tid);
    if(!$minfo)
        throw new sysExcption('找不到产品信息！');

    $price = $minfo['price'];
    if($price<0.01)
        return true;

    //如果是服务商品，则检测是否在服务时间范围内
    if($isservice){
        $time = time();
        $mod = model('order_detail');
        $inslist = $mod->where("create_users_id=$users_id and ptype='$type' and tid='$tid' and state>0 and stime<$time and $time<etime")->find();
        return !empty($inslist);
    }else{
        $mod = model('order_detail');
        $mod->where("create_users_id=$users_id and ptype='$type' and tid='$tid' and state>0")->find();
        $mod->orderinfo();
        return $mod['order']['state']>0;
    }
}

/**根据配置过滤内容
 * @param $context
 * @return string|string[]
 */
function replacetxt($context){
    $fts = explode('|',conf('filtertxt'));
    usort($fts,function ($a,$b){
        return strlen($a)>strlen($b)?-1:1;
    });
    $rstr = conf('replacetxt');
    foreach ($fts as $f) {
        $context = str_replace($f,$rstr,$context);
    }
    return $context;
}

/** 创建订单
 * @param $type category article pages  三种类型
 * @param $tid 对应的表的Id
 */
function create_order($users_id,$type,$tid,$discount=1,$pcount=1,$remark=''){
    $so = model('order');

    $date = new \DateTime();
    $orderid = ($date->format('ymdHisu') . randChar(6, 'number'));
    $data['order_id'] = $orderid;
    //$data['order_type']=$type;
    //$data['tid']=$tid;

    //获取订单价格
    $mt = model($type)->get($tid);
    if(!$mt){
        throw new sysExcption('找不到该商品信息！');
    }
    $price=$mt['price']*$discount;
    $data['sumprice']=$price;
    $data['sourceprice']=$mt['price'];
    $data['discount']=$discount;
    $data['pcount']=$pcount;


    //获取购买人地址等
    $mu = model('users')->get($users_id);
    if(!$mu){
        throw new sysExcption('找不到购买人信息！');
    }

    $data['create_users_id']=$users_id;
    $data['address']=$mu['city'].$mu['address'];
    $data['mobile']=$mu['address'];
    $data['contact']=$mu['realname'];

    $data['state']=0;
    $data['remark']=$remark;

    $mdd=model('order_detail');
    //添加订单详细
    $dd['ptype']=$type;
    $dd['tid']=$tid;
    $dd['order_id']=$orderid;
    $dd['num']=1;
    $dd['price']=$price;
    $dd['sumprice']=$price;
    $dd['create_users_id']=$users_id;

    \heephp\database\mysqli::BEGINTRAN();
    $eff = $so->insert($data);
    $eff2 = $mdd->insert($dd);
    $istrue = \heephp\database\mysqli::COMMIT();

    if ($istrue) {
        return $orderid;
    } else {
        return false;
    }
}