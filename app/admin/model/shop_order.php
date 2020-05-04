<?php

namespace app\admin\model;
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
        $re = new relation($this,'users','create_users_id','users_id');
        return $re->belong();
    }

}