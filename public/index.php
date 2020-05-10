<?php
if(version_compare(PHP_VERSION,'7.3.0','<'))die('You Need PHP Version > 7.3.0 ! , You PHP Version = ' . PHP_VERSION);

//是否是多应用
define('APPS',true);

    include_once './../heephp/heephp.php';
    $sys = new \heephp\heephp();
    $sys->run();