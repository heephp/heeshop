<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class link extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "连接分类|必填;标题|必填+唯一;网址|不能为空;排序|填写数字+必填";
    protected $update_validata = "link_group_id|must;title|must+unique;url|must;ord|int+must";
    protected $softdel = false;
    protected $key = 'link_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function child(){
        $re = new relation($this,'link','link_id','parent_id','child');
        return $re->hasmore(false);
    }

    public function parent(){
        $re = new relation($this,'link','parent_id','link_id','parent');
        return $re->belong();
    }

    public function linkgroup(){
        $re = new relation($this,'link_group','link_group_id','link_group_id','linkgroup');
        return $re->belong();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }


}