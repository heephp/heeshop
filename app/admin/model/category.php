<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class category extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "分类名|必填+已经存在;关键词|必填;";
    protected $update_validata = "name|must+unique;keyword|must;";
    protected $softdel = true;
    protected $key = 'category_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function child(){
        $re = new relation($this,'category','category_id','parent_id','child');
        $re->set_rmodel_methods('create_user');
        return $re->hasmore(false);
    }

    public function parent(){
        $re = new relation($this,'category','parent_id','category_id','parent');
        return $re->belong();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }

    /*public function model(){
        $re = new relation($this,'model','model_id','model_id','model');
        return $re->belong();
    }*/
}