<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class pages extends basefilter
{
    protected $autotimespan = true;
    protected $update_message_validata = "路由|已经存在;标题|必填;内容|必填;模板|必须选择";
    protected $update_validata = "route|unique;title|must;body|must;template|must;";
    protected $softdel = true;
    protected $key = 'pages_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function create_user()
    {

        $relation = new relation($this,/*'belong',*/ 'users', 'create_users_id', 'users_id', 'create_user');
        return $relation->belong();
    }
}