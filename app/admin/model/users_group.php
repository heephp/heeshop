<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class users_group extends model
{

    protected $autotimespan = true;
    protected $update_message_validata = "用户组名称|必填+字母数字下划线中文最少3位+名称已经存在;";
    protected $update_validata = "name|must+alphaNumDashChinese=3+unique;";
    protected $softdel = true;

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;

    }

    public function create_user(){

        $relation = new relation($this,/*'belong',*/'users','create_users_id','users_id','create_user');
        return $relation->belong();
    }

    public function sys_resources(){

        $relation = new relation($this,/*'moretomore',*/'sys_resources','users_group_id','sys_resources_id','','users_group_sys_resources');
        return $relation->moretomore(false);

    }

    public function find($where, $onlysoftdel = false)
    {
        $cachename = md5($where.'_'.$onlysoftdel);
        $this->data = cache($cachename);
        if (empty($this->data)) {
            $this->data = parent::find($where,$onlysoftdel);
            cache($cachename, $this->data);
            return $this->data;
        }
        return $this->data;
    }

    public function get($id, $onlysoftdel = false)
    {
        $cachename = md5($id.'_'.$onlysoftdel);
        $this->data = cache($cachename);
        if (empty($this->data)) {
            $this->data = parent::get($id,$onlysoftdel);
            cache($cachename, $this->data);
            return $this->data;
        }
        return $this->data;
    }


}