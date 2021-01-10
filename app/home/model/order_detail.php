<?php
namespace app\home\model;
use heephp\model;
use heephp\relation;

class order_detail extends model
{
    protected $autotimespan = true;
    protected $key = 'order_detail_id';
    protected $update_message_validata = "订单类型|必填;关联表ID|必填;";
    protected $update_validata = "ptype|must;tid|must;";

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function orderinfo(){
        $relation = new relation($this,'order','order_id','order_id','order');
        return $relation->belong();
    }

    public function product(){
        $ds = $this->data;
        if(empty($ds))
            return;
        $isline = empty($ds[0][array_key_first($ds[0])]);
        if($isline){
            $this->data['product']= model($ds['ptype'])->get($ds['tid']);
            return;
        }

        for($i=0;$i<count($this->data);$i++) {
            $d = $this->data[$i];
            $this->data[$i]['product'] = model($d['ptype'])->get($d['tid']);
        }
    }



}