<?php
use heephp\route;

/*route::domain(['a.c.com' => '/admin',
                'b.c.com' => '/home',]);
*/
route::get(['/alipay_pc_' => '/home/alipay/pay/',
        '/wxpay_pc_' => '/home/wxpay/pay/']);

route::dir('/skins/'.conf('website_skin'),'/home/index');