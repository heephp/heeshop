<?php
namespace app\home\model;
use heephp\model;
use heephp\relation;

class order extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "订单号|已经存在;订单类型|必填;关联表ID|必填;";
    protected $update_validata = "order_id|unique;order_type|must;tid|must;";
    protected $softdel = true;
    protected $key = 'order_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function detail(){
        $relation = new relation($this,/*'belong',*/'order_detail','order_id','order_id','detail');
        $relation->set_rmodel_methods('product');
        return $relation->hasmore(false);
    }

    

}