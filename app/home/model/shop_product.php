<?php

namespace app\home\model;
use heephp\model;
use heephp\relation;
use heephp\sysExcption;

class shop_product extends model
{
    protected $autotimespan = true;
    protected $softdel = true;

    public function __construct()
    {
        $this->key = 'shop_product_id';

        parent::__construct(__CLASS__);


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

    public function attrs(){
        $re = new relation($this,'shop_product_attr',$this->key,'shop_product_id','attrs');
        return $re->hasmore();
    }

    public function skus(){
        $re = new relation($this,'shop_product_sku',$this->key,'shop_product_id','skus');
        return $re->hasmore();
    }


}