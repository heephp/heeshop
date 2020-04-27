<?php
namespace heephp;
class config{

    private static $config=[];

    private function __construct()
    {

        $sys_config = [];
        if(is_file('./../app/config.php'))
            $sys_config = require './../app/config.php';

        //读取应用中的单独配置
        if(defined('APP')) {
            if (is_file('./../app/' . APP . '/config.php')) {
                $app_config = require './../app/' . APP . '/config.php';
                foreach ($app_config as $k=>$v){
                    if(is_array($v)){
                        $sys_config[$k] = array_merge($sys_config[$k], $app_config[$k]);
                    }else{
                        $sys_config[$k] = $v;
                    }
                }

            }
        }

        config::$config = $sys_config;

        aop('config_init',config::$config);
    }

    private function _get(){
        return config::$config;
    }

    public static function get($name=''){

        $instance = new self();
        $configs= config::$config;

        if(empty($name)) {
            return $configs;
        }
        //var_dump($configs);
        if(strstr($name,'.')!=''){
            $names=explode('.',$name);
            if(empty($names[1]))
                return $configs[$names[0]];
            return $configs[$names[0]][$names[1]];
        }
        //var_dump($configs);
        return $configs[$name];
    }

}