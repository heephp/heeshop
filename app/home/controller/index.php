<?php
namespace app\home\controller;
use  heephp\controller;
use heephp\formbulider;
use heephp\wherebuild;

class index extends base{

    public function __construct()
    {
        parent::__construct();

        //读取配置
        $config=model('config');
        $webconfig = $config->getall();
        $this->assign('c',$webconfig);

        //读取菜单
        $lg = model("link_group");
        $lg->select();
        $lg->links();

        foreach ($lg->data as $l){
            $this->assign($l['tag'],$l['links']);
        }

    }


    public function  index(){

        return $this->fetch();
    }

    public function contact(){

        return $this->fetch();
    }

    public function test()
    {
        $result =
            table('users')
            ->where(function (\heephp\orm\wherebuilder $wsql) {
                return $wsql->whereBetween('users_id',0,3)->sql();
            })
            ->whereOr(function (\heephp\orm\wherebuilder $wsql){
                return $wsql->where('1=1')->whereAnd('2=2')->sql();
            })
            ->sql();
        return var_dump($result);

    }

}