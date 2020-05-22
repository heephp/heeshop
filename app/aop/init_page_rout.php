<?php
namespace app\aop;
use heephp\route;
class init_page_rout{

    public function run(){

        $list = table('pages')->select();
        foreach ($list as $item){
            if(!empty(trim($item['route']))){
                route::get('/'.$item['route'],'/home/index/page/'.$item['pages_id']);
            }
        }

    }

}