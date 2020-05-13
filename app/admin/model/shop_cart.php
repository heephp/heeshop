<?php

namespace app\admin\model;
use heephp\model;
use heephp\relation;

class shop_cart extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "商品|不能为空;";
    protected $update_validata = "shop_product_id|must;";
    protected $softdel = false;

    public function __construct()
    {
        $this->key = 'shop_cart_id';

        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;

    }

    public function product(){
        $re = new relation($this,'shop_product','shop_product_id','shop_product_id','product');
        return $re->belong();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }

}