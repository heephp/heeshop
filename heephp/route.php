<?php
namespace heephp;
class route{
    private $routes=array();
    private function __construct()
    {
        $rfile = './../app/route.php';
        if(is_file($rfile)){
            $this->routes=require $rfile;
        }

        aop('route_init');
    }


    /*
     * 当前url匹配的路由
     * 没有匹配的路由返回false
     */
    public static function get($url){

        $route = new route();
        $rs= $route->routes;

        $xstart = strpos($url,'/');
        $url=($xstart==0)?substr($url,$xstart+1):$url;

        foreach ($rs as $k=>$v){
            $single=preg_match('/'.$k.'/i',$url);
            if($single){
                return preg_replace('/'.$k.'/i',$v,$url);
            }
        }
        return false;
    }

    /*
     * 注册pagetag以过滤url中的page参数
     */
    public static function reg_pagetag($tag){
        $_pagetag=request('session.page_parms_tags');

        if(!is_array($_pagetag)){
            $_pagetag[] = $tag;
            request('session.page_parms_tags',$_pagetag);
            return;
        }

        if(!in_array($tag,$_pagetag)) {
            $_pagetag[] = $tag;
            request('session.page_parms_tags',$_pagetag);
        }

    }

    public static function get_pagetag()
    {
        $_pagetag=request('session.page_parms_tags');
        return $_pagetag;
    }

}