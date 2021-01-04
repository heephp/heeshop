<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class article extends basefilter
{
    protected $autotimespan = true;
    protected $update_message_validata = "标题|必填;内容|必填;分类|不能为空;";
    protected $update_validata = "title|must;context|must;category_id|must;";
    protected $softdel = true;
    protected $key = 'article_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);


        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;
    }

    public function category(){
        $re = new relation($this,'category','category_id','category_id');
        return $re->belong();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }


}