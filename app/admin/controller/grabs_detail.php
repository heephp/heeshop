<?php
namespace app\admin\controller;

use heephp\validata;

class grabs_detail extends adminBase
{

    public function list(){
        return $this->fetch();
    }

}