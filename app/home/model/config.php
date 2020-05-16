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

    public function getall(){

        $webconfig= cache('webconfig');

        if(!$webconfig) {
            $webconfig = $this->field(['name', 'value'])->select();
            cache('webconfig', $webconfig);
        }

        $list = [];
        foreach($webconfig as $item){
            $list[$item['name']]=$item['value'];
        }

        return $list;

    }
}
