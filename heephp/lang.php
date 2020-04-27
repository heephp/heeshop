<?php
namespace heephp;

class lang{
    //默认的当前语言包
    public $language= 'zh-cn';
    public $langs=array();
    private $dir = './../lang/';
    private $langpack = array();//对应语言包内容

    public  function __construct()
    {
        //读取可用的语言包文件
        if(is_dir($this->dir)){

            $list = scandir($this->dir);
            foreach ($list as $a){
                $a1 = explode('.',$a);
                if($a!='.'&&$a!='..'&&$a1[1]=='php'&&count($a1)==2){
                    $this->langs[]=$a;
                }
            }


        }

        //开启多语言
        if(config::get('lang.on')==true){
            $this->language = config::get('lang.default') ?? 'zh-cn';
            $langfile = $this->langfile();
            if(!is_file($langfile)){
                throw new sysExcption('找不到对应语言包：'.$langfile);
            }
            $this->langpack = require $this->dir.$this->language.'.php';
        }
        else{
            $this->langpack=array();
        }

        aop('lang_init');

    }

    //返回当前语言内容
    public function get(){
        return $this->langpack;
    }



    //返回当前语言包文件路径
    private function langfile(){
        return $this->dir.$this->language.'.php';
    }


}