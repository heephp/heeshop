<?php
namespace app\home\model;
use heephp\model;
use heephp\relation;

class config extends model
{

    public function __construct($tablname)
    {
        parent::__construct(__CLASS__);
    }

    public function all(){

        $webconfig= cache('webconfig');

        if(!$webconfig) {
            $webconfig = $this->select('1=1', 'id asc', '`name`,`value`');
            cache('webconfig',$webconfig);
        }

        $list = [];
        foreach($webconfig as $item){
            $list[$item['name']]=$item['value'];
        }

        return $list;

    }
}
