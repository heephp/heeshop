<?php
namespace app\aop;
use heephp\config;

class init_skin
{
    public function run()
    {
        if (APP == 'home') {
            config('skin_dir', 'skins');
            config('skin', conf('website_skin'));
        }
    }

}