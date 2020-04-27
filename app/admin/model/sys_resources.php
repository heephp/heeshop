<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class sys_resources extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "标题|必填+字母数字下划线中文最少3位;路径|不能为空+该路径已经存在;";
    protected $update_validata = "title|must+alphaNumDashChinese=3;path|must+unique;";
    protected $key='sys_resources_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata ;
        $this->insert_message_validata = $this->update_message_validata ;
    }

    public function child(){
        $relation = new relation($this,/*'hasmore',*/'sys_resources',$this->key,'parent_id','child');
        $relation->set_rmodel_methods('create_user');
        return $relation->hasmore(false);
    }

    public function create_user(){
        $relation = new relation($this,/*'belong',*/'users','users_id','users_id','create_user');
        return $relation->belong();
    }

}