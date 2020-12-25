<?php
namespace heephp;
class config{

    private static $config=[];
    private static $sys_config=[];
    private static $app_config=[];
    private static $sysfile='./../app/config.php';
    private static $appfile = '';

    private function __construct()
    {

        if (is_file(self::$sysfile))
            self::$sys_config = require self::$sysfile;
        //var_dump(self::$sys_config);

        self::$config = array_merge(self::$config, self::$sys_config);

        //读取应用中的单独配置
        if (APPS && defined('APP')) {

            self::$appfile = './../app/' . APP . '/config.php';
            if (is_file(self::$appfile)) {
                self::$app_config = require self::$appfile;
                foreach (self::$app_config as $k => $v) {
                    if (is_array($v)) {

                        self::$config[$k] = array_merge(self::$sys_config[$k], self::$app_config[$k]);
                    } else {
                        self::$config[$k] = $v;
                    }
                }

            }
        }

        //self::$config = $sys_config;

        aop('config_init', self::$config);
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
        //self::$config[$name]=$value;
        //return self::$config[$name];
        //self::$new_arr_str="";


        //判断应用配置是否存在
        if(APPS){
            if (!empty(self::$app_config)) {
                if(strstr($name,'.')!=''){

                    $names = explode('.', $name);

                    if(array_key_exists($names[0],self::$app_config)) {
                        if(array_key_exists($names[1],self::$app_config[$names[0]])) {

                            self::$app_config[$names[0]][$names[1]] = $value;
                            self::garr(self::$app_config,self::$appfile);
                            return $value;
                        }
                    }

                }else{
                    //如果一级配置
                    if(array_key_exists($name,self::$app_config)){
                        //如果是应用级别配置
                        self::$app_config[$name]=$value;
                        self::garr(self::$app_config,self::$appfile);
                        return $value;
                    }
                }

            }
        }


        //如果系统级别配置
        if(strstr($name,'.')!=''){
            $names = explode('.', $name);
            self::$sys_config[$names[0]][$names[1]]=$value;
        }else{
            self::$sys_config[$name]=$value;
        }

        self::garr(self::$sys_config,self::$sysfile);//'<?php ['.self::set_arr(self::$sys_config).'];';
        return $value;
    }

    /**
     * 生成配置文件
     * @param $arr
     * @param $fname
     */
    private static function garr($arr,$fname)
    {
        $str = var_export($arr,true);
        $str=str_replace('array (','[',$str);
        $str=str_replace('),','],',$str);
        $str=substr($str,0,strlen($str)-1).']';
        $str = "<?php \r\n return ".$str.';';

        $handle = fopen($fname, "w");
        fwrite($handle,$str);
        fclose($handle);
    }
}