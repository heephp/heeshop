<?php
namespace app\home\controller;
use app\admin\controller\model;
use app\home\model\category;
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

        return $this->fetch(conf('skin_index'));
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

    public function page($id){

        $mp = model('pages');
        $p = $mp->get($id);

        if(!$p){
            return $this->error('页面不存在！');
        }else{
            $this->assign('m',$p);
            return $this->fetch($p['template']);
        }

    }

    public function list($category_id){
        $cate = new category();
        $mc = $cate->get($category_id);
        if(!$mc){
            return $this->error('栏目不存在~');
        }

        $cate->model();
        //是否是系统模型
        $issys = $cate['model']['is_sys'];
        if($issys){
            //如果是系统模型
            $table = $cate['model']['table_name'];
            $model = model($table);

        }else{
            //如果不是系统模型
            $mt = model('model_table');
            $mt->get($cate['model']['model_table_id']);
            $table = $mt->data['name'];

            $model = modeluser($table);
        }


        $model->where('category_id='.$category_id)->page();
        $this->assign('list',$model->data);
        $this->assign('pager',$model->pager['show']);

        return $this->fetch($mc['template_list']);
    }

    public function detail($category_id,$id){
        $cate = new category();
        $mc = $cate->get($category_id);
        if(!$mc){
            return $this->error('栏目不存在~');
        }

        $cate->model();
        //是否是系统模型
        $issys = $cate['model']['is_sys'];
        if($issys){
            //如果是系统模型
            $table = $cate['model']['table_name'];
            $model = model($table);

        }else{
            //如果不是系统模型
            $mt = model('model_table');
            $mt->get($cate['model']['model_table_id']);
            $table = $mt->data['name'];

            $model = modeluser($table);
        }


        $model->get($id);
        $this->assign('m',$model->data);

        return $this->fetch($mc['template_detail']);
    }

}