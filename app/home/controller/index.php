<?php
namespace app\home\controller;
use app\admin\controller\model;
use app\home\model\category;
use  heephp\controller;
use heephp\formbulider;
use heephp\sysExcption;
use heephp\wherebuild;

class index extends base
{

    /* public function  index(){

         return $this->fetch(conf('skin_index'));
     }*/


    public function test()
    {
        $result =
            table('users')
                ->where(function (\heephp\orm\wherebuilder $wsql) {
                    return $wsql->whereBetween('users_id', 0, 3)->sql();
                })
                ->whereOr(function (\heephp\orm\wherebuilder $wsql) {
                    return $wsql->where('1=1')->whereAnd('2=2')->sql();
                })
                ->sql();
        return var_dump($result);

    }

    /*
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

        public function product($category_id=0){

            $prod = model('shop_product');
            $prod->where(empty($category_id)?'1=1':'category_id='.$category_id)->page();
            $this->assign('list',$prod->data);
            $this->assign('pager',$prod->pager['show']);

            return $this->fetch('/product');
        }*/

    public function Empty($name, $arguments)
    {
        //base::__construct();
        $skin = conf('website_skin');//echo $skin.'/'.$name;
        $dir = ROOT . '/skins/' . $skin . '/' ;

        if (strpos($name, '_') > -1) {
            if (!file_exists($dir.$name.'php'))
                $name = str_replace('_', '/', $name);
        }

        $file = $dir. $name . '.php';
        if (!file_exists($file)) {
            throw new sysExcption('找不到文件');
            return;
        }

        return $this->fetch('/' . $name);
    }
}