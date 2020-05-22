<?php
namespace app\admin\controller;

use heephp\bulider\form;
use heephp\config;

class moban extends adminBase
{

    public function setting(){

        $fname = ROOT.'/skins/'.conf('website_skin').'/page.json';
        if(!is_file($fname))
        {
            $this->assign('msg','当前模板不需要设置');
            return $this->fetch();
        }
        $sett = json_decode(file_get_contents($fname),true);
        $form = new form('save_setting');
        return $this->fetch();
    }

}