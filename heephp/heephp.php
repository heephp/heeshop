<?php
namespace heephp;

define('SOFTNAME','heephp');
define('VERSION','3.3.1');
define('ROOT',dirname($_SERVER["DOCUMENT_ROOT"]));

include_once 'function.php';
include_once 'controller.php';
include_once 'validata.php';
include_once 'route.php';
include_once 'sysExcption.php';
include_once 'trace.php';
include_once 'lang.php';
include_once 'aop.php';
include_once 'relation.php';
include_once 'logger.php';
include_once 'config.php';

if(is_file('./../app/function.php'))
    include_once './../app/function.php';

session_start();
trace::set_run_start_time();

class heephp
{

    public function __construct()
    {
        aop('app_init');
        //加载语言包
        $l = new lang();
    }


    public function run()
    {
        aop('app_start');
        $route = route::create();


        //匹配到跳转
        $mredirect = $route->match_redirect();
        if ($mredirect) {
            if (is_callable($mredirect)) {
                $mredirect = $mredirect();
            }
            $url = (($mredirect & 'http://') == 'http://') ? $mredirect : (($mredirect & 'https://') == 'https://' ? $mredirect : url($mredirect));
            header('Location:' . $url);
            return;
        }

        //匹配到文件
        $mfile = $route->match_file();
        if ($mfile) {
            if (is_callable($mfile)) {
                $mfile = $mfile();
            }
            $fileinfo = fopen($mfile, 'r');
            header("Content-Type:application/octet-stream");
            header("Accept-Ranges:bytes");
            header("Accept-Length:" . filesize($mfile));
            header("Content-Disposition:attachment;filename=" . $mfile);
            echo fread($fileinfo, filesize($mfile));
            fclose($fileinfo);
            return;
        }

        //匹配到域名
        $mdomain = $route->match_domain();
        if ($mdomain) {
            if (is_callable($mdomain)) {
                echo $mdomain();
                return;
            } else {
                $uinfo = explode('/', $mdomain);
                $domain_uinfo = $route->get_detail_form_urlinfos($uinfo);
                $this->mvc($domain_uinfo);
                return;
            }
        }

        //匹配到普通路由
        $murl = $route->match_url();
        $murl = $route->get_detail_form_urlinfos($murl);
        $this->mvc($murl);

        aop('app_end');
    }

    private function mvc($uinfo)
    {
        //获取应用-控制器-方法名，参数信息
        $app = $uinfo['app'];
        $controller = $uinfo['controller'];
        $method = $uinfo['method'];
        $parms = $uinfo['parms'];
        $page = $uinfo['page'];
        //urlpaser($app, $controller, $method, $parms);

        define('APP', $app);
        define('CONTROLLER', $controller);
        define('METHOD', $method);
        define('PARMS', $parms);
        define('PAGE',$page);

        aop('app_loaded');

        //调用控制器
        $controllerINSTANCE = null;
        $controllerNAME = 'app\\';

        if (APPS)
            $controllerNAME .= $app . '\controller\\' . $controller;
        else
            $controllerNAME .= 'controller\\' . $controller;

        $controllerINSTANCE = new $controllerNAME();

        try {

            try {
                $reinfo = call_user_func_array(array($controllerINSTANCE, $method), $parms);
            } catch (\Exception $e) {
                throw new sysExcption($e->getMessage(), $e->getCode(), $e->getTrace());
            } catch (\Error $e) {
                throw new sysExcption($e->getMessage(), $e->getCode(), $e->getTrace());
            }

        } catch (\heephp\sysExcption $e) {
            echo $e->show();
            exit;
        }

        echo $reinfo;
    }

}
