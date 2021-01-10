<?php
namespace app\home\controller;
use app\home\model\category;
use  heephp\controller;
use heephp\formbulider;
use heephp\sysExcption;
use heephp\wherebuild;

class index extends base
{

     public function  index(){

         return $this->fetch();
     }

    public function  _list($id)
    {
        $cates = model('category');
        $m = $cates->get($id);
        $cates->parent();
        $this->assign('cate',$cates->data);

        $article = model('article');
        $list = $article->where("category_id=$id")->order('create_time desc')->page();

        $this->assign('list', $list);
        $this->assign('pager', $article->pager['show']);

        return $this->fetch($m['template']);
    }

    public function  detail($id){

        $article = model('article');
        $m = $article->get($id);
        $article->setDec('hit',$m['hit']++);

        $cates = model('category');
        $c = $cates->get($m['category_id']);
        $cates->parent();
        $this->assign('cate',$cates->data);

        $this->assign('m',$m);
        return $this->fetch($c['template_detail']);
    }


    public function api_get_setting(){
        $safecode = request('get.safecode');
        $username = request('get.username');
        $sign = request('get.sign');
        if($safecode!=conf('site_safecode')){
            return json(['code'=>'error','msg'=>'安全码错误！']);
        }
        if($safecode!=conf('site_username')){
            return json(['code'=>'error','msg'=>'登录名错误！']);
        }
        if($sign!=md5($safecode.$username.$safecode)){
            return json(['code'=>'error','msg'=>'签名错误！']);
        }

        $conf = table('config')->field(['name','value'])->all();
        return json(['code'=>'success','data'=>$conf]);
    }

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

    public function page($id)
    {

        $page = model('pages');
        $m = $page->get($id);
        $this->assign('m', $m);
        return $this->fetch($m['template']);
    }

}