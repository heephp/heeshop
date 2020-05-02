<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class model_table extends model
{
    protected $autotimespan = true;
    public function __construct()
    {
        parent::__construct(__CLASS__);

    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }
}