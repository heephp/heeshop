<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class menus extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "标题|必填+已经存在;链接|必填;排序|必填";
    protected $update_validata = "title|must+unique;link|must;ord|must";
    protected $softdel = true;

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata ;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function create_user(){

        $relation = new relation($this,/*'belong',*/'users','create_users_id','users_id','create_user');
        return $relation->belong();
    }

    public function child(){

        $relation = new relation($this,'menus',$this->key,'parent_id','child');
        $relation->set_rmodel_methods('create_user');
        $relation->set_rmodel_order('ord asc');
        return $relation->hasmore(false);
    }

    public function select()
    {
        $cachename = md5($this->where.$this->order);
        $this->data = cache($cachename);
        if (empty($this->data)) {
            parent::select();
            cache($cachename, $this->data);
            return $this->data;
        }
        return $this->data;
    }

   /*public function page($where = '1=1', $order = '', $fields = '*', $onlySoftDel = false, $pname = 'page', $page = 0)
    {
        $cachename = md5(implode('_',func_get_args()));
        $this->data = cache($cachename);

        if (empty($this->data)) {
            $this->data = parent::page($where,$order,$fields,$onlySoftDel,$pname,$page);
            cache($cachename, $this->data);
            return $this->data;
        }
        return $this->data;
    }*/
}