<?php
namespace app\admin\controller;


class shop_cart extends adminBase
{
    public function index(){
        return $this->fetch();
    }
}