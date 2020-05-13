<?php

namespace app\home\model;
use heephp\model;
use heephp\relation;

class shop_order extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "联系人|不能为空;地址|不能为空;手机号|不能为空;总价|不能为空;";
    protected $update_validata = "contact|must;address|must;mobile|must;sumprice|must;";
    protected $softdel = true;

    public function __construct()
    {
        $this->key = 'shop_order_id';

        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;

    }

    public function products(){
        $re = new relation($this,'shop_product',$this->key,'shop_order_id','products');
        return $re->hasmore();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }

    public function set_shop_order_id($val)
    {
        $date = new \DateTime();
        return empty($val) ? ($date->format('ymdHisu') . randChar(6, 'number')) : $val;
    }

    public function get_state($val){

        switch ($val){
            case 0:
                return '待付款';
            case 1:
                return '待发货';
            case 2:
                return'待收货';
            case 3:
                return'待评价';
            case 4:
                return'完成';
            case -1:
                return'申请退款';
            case -2:
                return '确认退款';
            case -3:
                return'完成退款';

        }
    }

}