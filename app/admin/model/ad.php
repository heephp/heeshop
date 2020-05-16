<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class ad extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "标题|必填;链接|必填;";
    protected $update_validata = "title|must;link|must;";
    protected $softdel = true;
    protected $key = 'ad_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }
}