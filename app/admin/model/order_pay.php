<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class order_pay extends model
{
    protected $autotimespan = true;
    protected $key = 'order_pay_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

    }

    public function orderinfo(){
        $relation = new relation($this,'order','order_id','order_id','order');
        return $relation->belong();
    }

    public function create_user(){
        $relation = new relation($this,'users','create_users_id','users_id','create_user');
        return $relation->belong();
    }

}