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

    public function plist(){

        return $this->fetch();
    }

    public function  detail($id){

        $article = model('article');
        $m = $article->get($id);
        $article->setDec('hit',$m['hit']++);

        $cates = model('category');
        $cates->get($m['category_id']);
        $cates->parent();
        $this->assign('cate',$cates->data);

        $this->assign('m',$m);
        return $this->fetch($m['template']);
    }

    public function pdetail(){

        return $this->fetch();
    }

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
}