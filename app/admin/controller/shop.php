<?php
namespace app\admin\controller;


class shop extends adminBase
{
    public function index(){
        return $this->fetch();
    }
}