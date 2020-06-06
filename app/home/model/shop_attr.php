<?php

namespace app\home\model;
use heephp\model;
use heephp\relation;

class shop_attr extends model
{
    protected $autotimespan = false;
    protected $softdel = false;

    public function __construct()
    {
        $this->key = 'shop_attr_id';

        parent::__construct(__CLASS__);


    }

    public function get_attrs(){
        return $this->page();
    }

    //将值转为数组
    public function get($id=''){
        $m = parent::get($id);
        $m['values']=explode(',',$m['values']);
        return $m;
    }


}