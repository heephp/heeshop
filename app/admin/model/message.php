<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class message extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "标题|必填;内容|不能为空;";
    protected $update_validata = "title|must;context|must;";
    protected $softdel = true;

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata ;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function sender(){
        $relation = new relation($this,/*'belong',*/'users','users_id','users_id','sender');
        return $relation->belong();
    }

    public function receiver(){
        $relation = new relation($this,/*'belong',*/'users','receiver_users_id','users_id','receiver');
        return $relation->belong();
    }

    public function selectTop($where = '1=1', $order = '', $fields = '*', $onlySoftDel = false, $pname = 'page', $page = 1)
    {
        return parent::select($where, $order, $fields, $onlySoftDel, $pname, $page);
    }

}