<?php
namespace app\admin\model;
use heephp\logger;
use heephp\model;
use heephp\relation;

class comment extends basefilter
{
    protected $autotimespan = true;
    protected $softdel=true;

    protected $update_message_validata = "栏目编号|必填;信息编号|必填;评论内容|不能为空;";
    protected $update_validata = "category_id|must;info_id|must;context|must;";
    protected $key = 'comment_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata=$this->update_message_validata;

    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }

    public function category(){
        $re = new relation($this,'category','category_id','category_id','category');
        return $re->belong();
    }
}