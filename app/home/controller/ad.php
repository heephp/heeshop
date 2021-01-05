<?php
namespace app\home\controller;
use app\home\model\category;
use  heephp\controller;
use heephp\formbulider;
use heephp\sysExcption;
use heephp\wherebuild;

class ad extends base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function to($id){
        $ad = model('ad');
        $m = $ad->get($id);
        $ad->setInc('hit',1);
        if(strpos($m['link'], 'https://') === 0||strpos($m['link'], 'http://') === 0){
            Header('Location: '.$m['link']);
        }else{
            $this->redirect(url($m['link']));
        }
        exit();
    }

}