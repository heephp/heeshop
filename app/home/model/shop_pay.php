<?php

namespace app\home\model;
use heephp\model;
use heephp\relation;

class shop_pay extends model
{
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }

    public function shop_order(){
        $re = new relation($this,'shop_order','shop_order_id','shop_order_id');
        return $re->belong();
    }


}