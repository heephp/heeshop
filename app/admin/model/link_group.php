<?php

namespace app\admin\model;

use heephp\model;
use heephp\relation;

class link_group extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "标记|必填+字母且不少于5个+已经存在;名称|必填";
    protected $update_validata = "tag|must+alpha=5+unique;title|must";
    protected $softdel = false;
    protected $key = 'link_group_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function links()
    {
        $re = new relation($this, 'link', 'link_group_id', 'link_group_id', 'links');
        return $re->hasmore(false);
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }

}