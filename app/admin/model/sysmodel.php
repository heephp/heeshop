<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class sysmodel extends model
{
    protected $autotimespan=true;
    protected $table='model';
    protected $softdel=true;
    public function __construct()
    {
        parent::__construct('model');
    }

    public function model_table(){
        $re = new relation($this,'model_table','model_table_id','model_table_id');
        return $re->belong();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id','create_user');
        return $re->belong();
    }



}