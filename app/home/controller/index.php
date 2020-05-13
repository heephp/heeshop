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
        $webconfig = $config->all();
        $this->assign('c',$webconfig);

        //读取菜单
        $lg = model("link_group");
        $lg->select();

        $link = model('link');
        foreach ($lg->data as $l){
            $ls = $link->where('parent_id<1 and link_group_id='.$l['link_group_id'])->order('ord asc')->select();
            $this->assign($l['tag'],$ls);
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
        $result = select('*')
            ->from('users')
            ->where(function (wherebuild $wsql) {
                return $wsql->whereBetween('users_id',0,3)->sql();
            })
            ->whereOr(function (wherebuild $wsql){
                return $wsql->where('1=1')->where('2=2')->sql();
            })
            ->all();
        return var_dump($result);
    }

}