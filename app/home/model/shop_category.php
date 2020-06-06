<?php

namespace app\home\model;
use heephp\model;
use heephp\relation;

class shop_category extends model
{
    protected $autotimespan = true;
    protected $softdel = true;

    public function __construct()
    {
        $this->key = 'shop_category_id';

        parent::__construct(__CLASS__);


    }

    public function skus(){

        $re = new relation($this,'shop_category_sku',$this->key,'shop_category_id','skus');
        return $re->hasmore();

    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }

    public function child(){
        $re = new relation($this,'shop_category','shop_category_id','parent_id','child');
        $re->set_rmodel_methods('create_user');
        return $re->hasmore(false);
    }

    public function attrs(){
        $re = new relation($this,'shop_attr',$this->key,'shop_attr_id','attrs','shop_category_attr');
        return $re->moretomore();
    }
}