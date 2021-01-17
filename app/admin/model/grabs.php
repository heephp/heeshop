<?php
namespace app\admin\model;

use heephp\model;
use heephp\relation;

class grabs extends model
{
    protected $autotimespan = true;
    protected $softdel=true;

    protected $update_message_validata = "栏目编号|必填;名称|必填;网址|必填;用户ID|必填;网址|必填;采集网址|必填;开始页码|必填;结束页码|必填;链接区域开始|必填;链接区域结束|必填;标题开始|必填;标题结束|必填;内容开始|必填;内容结束|必填;";
    protected $update_validata = "category_id|must;name|must;url|must;users_id|must;url|must;urls|must;startpage|must;endpage|must;linkstart|must;linkend|must;titlestart|must;titleend|must;contentstart|must;contentend|must;";
    protected $key = 'grabs_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata=$this->update_message_validata;

    }

    public function create_user(){
        $re = new relation($this,'users','users_id','users_id','create_user');
        return $re->belong();
    }

    public function category(){
        $re = new relation($this,'category','category_id','category_id','category');
        return $re->belong();
    }
}