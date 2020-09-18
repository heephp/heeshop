<?php
namespace heephp;
class config{

    private static $config=[];

    private function __construct()
    {

        $sys_config = [];
        if(is_file('./../app/config.php'))
            $sys_config = require './../app/config.php';

        $sys_config=array_merge(self::$config,$sys_config);

        //读取应用中的单独配置
        if(defined('APP')) {
            if (is_file('./../app/' . APP . '/config.php')) {
                $app_config = require './../app/' . APP . '/config.php';
                foreach ($app_config as $k=>$v){
                    if(is_array($k)){
                        $sys_config[$k] = array_merge($sys_config[$k], $app_config[$k]);
                    }else{
                        $sys_config[$k] = $v;
                    }
                }

            }
        }

        self::$config = $sys_config;

        aop('config_init',self::$config);
    }

    public static function get($name=''){

        new self();
        $configs= self::$config;

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

    public static function set($name,$value){

        new self();
        self::$config[$name]=$value;
        return self::$config[$name];

    }
}