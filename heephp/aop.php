<?php
namespace heephp;
class aop{
    private static $taglist = array();
    public function __construct()
    {

    }

    //注册一个切面的tag 注册事件
    private function register($name){

        //查询是否已经存在
        foreach (aop::$taglist as $item){
            if($item==$name){
                return false;
            }
        }
        //暂存内存中，以便查询
        aop::$taglist[]=$name;
    }

    /*
     * 调用事件对应的方法
     */
    public function invoke($name,&$parms=array()){
        //注册事件(暂时无用)
        $this->register($name);

            $aopfile='./../app/aop.php';
            $aopdir = './../app/aop/';

        if(!is_file($aopfile)) {
            return false;
        }

        $aoplist = require $aopfile;

        foreach ($aoplist as $tag=>$cls) {
            if(empty($tag))
                continue;
            if(empty($cls))
                throw new sysExcption('未指定AOP事件'.$tag.'的执行类');

            if($tag==$name){
                if(!is_file($aopdir.$cls.'.php')){
                    throw new sysExcption('未找到AOP类文件：'.$aopdir.$cls.'.php');
                }
                include_once $aopdir.$cls.'.php';

                if(!class_exists('\app\aop\\'.$cls)){
                    throw new sysExcption('未找到AOP类：'.'\app\aop\\'.$cls);
                }

                $clsname="\app\aop\\".$cls;
                $instance=new $clsname();

                if(!method_exists($instance,'run')){
                    throw new sysExcption('未找到AOP类'.'\app\aop\\'.$cls.'的方法run()');
                }

                $result = $instance->run($parms);
                $parms['result']=$result;
            }
        }
    }

}