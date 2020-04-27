<?php
namespace heephp;

define('SOFTNAME','heephp');
define('VERSION','1.1');
define('ROOT',dirname($_SERVER["DOCUMENT_ROOT"]));

include_once 'config.php';
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


if(is_file('./../app/function.php'))
    include_once './../app/function.php';

session_start();
trace::set_run_start_time();

class heephp
{

    protected $app, $controller, $method;
    protected $parms = array();

    public function __construct()
    {
        $l = new lang();
    }


    public function run()
    {
        //获取应用-控制器-方法名，参数信息
        $app = '';
        $controller = '';
        $method = '';
        $parms = array();
        urlpaser($app, $controller, $method, $parms);

        define('APP', $app);
        define('CONTROLLER', $controller);
        define('METHOD', $method);
        define('PARMS', $parms);

        aop('app_init');

        //调用控制器
        $controllerINSTANCE = null;
        $controllerNAME = 'app\\';
        if (APPS) {
            $cfile = './../app/' . $app . '/controller/' . $controller . '.php';
            if (is_file($cfile)) {
                include_once $cfile;
                $controllerNAME .= $app . '\controller\\' . $controller;
            } else {
                throw new sysExcption('找不到控制器文件' . $cfile);
            }
        } else {
            $cfile = './../app/controller/' . $controller . '.php';
            if (is_file($cfile)) {
                include_once $cfile;
                $controllerNAME .= 'controller\\' . $controller;
            } else {
                throw new sysExcption('找不到控制器文件' . $cfile);
            }
        }

        if (!class_exists($controllerNAME)) {
            throw new sysExcption($controllerNAME . '类不存在');
        }

        $controllerINSTANCE = new $controllerNAME($app, $controller, $method);

        if (!method_exists($controllerINSTANCE, $method)) {
            throw new sysExcption($controllerNAME . '类中' . $method . '方法不存在');
        }

        aop('app_start');

        try {
            $reinfo = call_user_func_array(array($controllerINSTANCE, $method), $parms);
        } catch (\Exception $e) {
            throw new sysExcption($e->getMessage(), $e->getCode());
        } catch (\Error $e) {
            throw new sysExcption($e->getMessage(), $e->getCode());
        }

        aop('app_end');

        echo $reinfo;
    }

}
