<?php

namespace app\admin\model;
use heephp\model;
use heephp\relation;

class shop_product extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "商品名称|必填;分类ID|不能为空;介绍|不能为空;";
    protected $update_validata = "name|must;category_id|must;detail|must;";
    protected $softdel = true;

    public function __construct()
    {
        $this->key = 'shop_product_id';

        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;

    }

    public function skus(){
        $re = new relation($this,'shop_product_sku',$this->key,'shop_product_id','skus');
        return $re->hasmore();
    }

    public function pics(){
        $re = new relation($this,'shop_product_pic',$this->key,'shop_product_id','pics');
        return $re->hasmore();
    }

    public function category(){
        $re = new relation($this,'shop_category','shop_category_id','shop_category_id','category');
        return $re->belong();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id');
        return $re->belong();
    }


}