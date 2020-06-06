<?php

namespace app\home\model;
use heephp\model;
use heephp\relation;

class shop_order_detail extends model
{
    protected $autotimespan = true;
    protected $softdel = true;

    public function __construct()
    {
        $this->key = 'shop_order_detail_id';

        parent::__construct(__CLASS__);
    }


    public function product(){
        $re = new relation($this,'shop_product','shop_product_id','shop_product_id','product');
        return $re->belong();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }


    public function get_sate($val){

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