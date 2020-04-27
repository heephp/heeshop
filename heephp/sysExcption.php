<?php
namespace heephp;

class sysExcption extends \Error
{
    public function __construct($msg,$code=0)
    {
        parent::__construct($msg,$code);
        $this->show();
        exit;
    }

    public function show(){

        if(!config('debug')){
            echo '页面出错~<br><br><a href="http://www.heephp.com" target="_blank">heephp</a>';
            return;
        }

        $msg = $this->message;
        $code = $this->code;
        $file = $this->getFile();
        $line = $this->getLine();
        $trace = $this->getTraceAsString();
        $traces = $this->getTrace();

        include_once 'message/sysExcption.php';
    }

}