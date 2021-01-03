<?php
namespace app\admin\model;
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

    public function get_state($val){
        switch ($val){
            case -3:
                return '已完成退款';
                break;
            case -2:
                return '已确认退款';
                break;
            case -1:
                return '申请退款';
                break;
            case 0:
                return '未支付';
                break;
            case 1:
                return '已支付未发货';
                break;
            case 2:
                return '已发货未确认';
                break;
            case 3:
                return '已确认未评论';
                break;
            case 4:
                return '已完成';
                break;
        }
    }

}