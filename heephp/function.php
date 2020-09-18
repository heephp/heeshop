<?php
//url获取
use heephp\logger;
use heephp\orm;
use heephp\route;
use heephp\sysExcption;


/***
 * 从get或Post中获取数据
 ***/
function request($name, $value = '')
{
    $gets = $_GET;
    $posts = $_POST;
    if (strpos($name, '.') > -1) {
        $action = '';
        $var = '';
        //$value = '';

        list($action, $var/*,$value*/) = explode('.', $name);
        if ($action == 'get' || $action == 'g' || $action == "GET" || $action == 'G') {
            if (empty($var))
                return inputfilter($gets);
            return inputfilter($gets[$var] ?? '');
        } else if ($action == 'post' || $action == 'p' || $action == "POST" || $action == 'P') {
            if (empty($var))
                return inputfilter($posts);
            return inputfilter($posts[$var] ?? '');
        } else if ($action == 'server' || $action == 'ser') {
            return $_SERVER[strtoupper($var)];
        } else if ($action == 'session') {
            if (empty($value)) {
                return $_SESSION[$var];
            } else {
                $_SESSION[$var] = $value;
                return $_SESSION[$var];
            }
        } else if ($action == 'cookie') {
            if (empty($value))
                return $_COOKIE[$var];
            else {
                setcookie($var, $value, time()+60*60*24*30);
                return $_COOKIE[$var];
            }
        }
    } else {
        return $gets[$name] ?? '';
    }
}

function cache($name = '', $value = '', $exp_time = 1)
{

    $cache = null;
    $diver = config('cache.diver');

    if ($diver == 'redis') {

        $cache = new \heephp\cache\redis($exp_time);

    } else if ($diver == 'memcached') {

        $cache = new \heephp\cache\memcached($exp_time);
    } else {

        $cache = new \heephp\cache\file($exp_time);
    }

    if (empty($name) && empty($value))
        return $cache;

    if (empty($value)) {
        return $cache->get($name);
    } else {
        return $cache->set($name, $value);
    }
}

/*
 * 上传文件
 */
function uploadfile($fname, $allowedExts, $allowfilesize, $dir, $nametype = 'md5')
{
    $info = [];
    // 允许上传的图片后缀
    $temp = explode(".", $_FILES[$fname]["name"]);
    $extension = end($temp);     // 获取文件后缀名
    if ((($_FILES[$fname]["size"] / 1024) > $allowfilesize))  // 文件大小
    {
        $info['error'] = "文件大小不符合要求,应该小于" . $allowfilesize . 'K';
        return $info;
    }
    if (!in_array($extension, $allowedExts)) {

        $info['error'] = "非法的文件格式，应该为：" . implode(',', $allowedExts);
        return $info;
    }  //文件类型

    if ($_FILES[$fname]["error"] > 0) {
        $info['error'] = $_FILES[$fname]["error"];
        return $info;
    } else {
        //如果未选择要上传的文件
        if (empty($_FILES[$fname]['name'])) {
            return NULL;
        }

        $info['source_name'] = $_FILES[$fname]["name"];
        $info['type'] = $_FILES[$fname]["type"];
        $info['size'] = ($_FILES[$fname]["size"] / 1024);
        $info['temp_name'] = $_FILES[$fname]["tmp_name"];

        // 判断当期目录下的 dir 目录是否存在该文件
        if (!is_dir($dir)) {
            $res = mkdir($dir, 0777, true);
            if (!$res) {
                $info['error'] = "目录 $dir 创建失败";
                return $info;
            }
        }
        // 如果没有 dir 目录，你需要创建它，upload 目录权限为 777
        if (file_exists($dir . $_FILES[$fname]["name"])) {
            $info['error'] = $_FILES[$fname]["name"] . " 文件已经存在。 ";
            return $info;
        }

        //生成文件名 默认 md5
        $filename = md5(time() . rand(1, 999999)) . '.' . $extension;

        if ($nametype == 'timespan')
            $filename = time() . rand(1, 999999) . '.' . $extension;
        else if ($nametype == 'guid')
            $filename = guid() . '.' . $extension;

        $info['name'] = $filename;
        $info['ext'] = $extension;
        $info['fullpath'] = $dir . '\\' . $filename;


        move_uploaded_file($_FILES[$fname]["tmp_name"], $dir . '\\' . $filename);
        return $info;

    }

    return $info;
}

function guid()
{
    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
    $hyphen = chr(45);// "-"
    $uuid = chr(123)// "{"
        . substr($charid, 0, 8) . $hyphen
        . substr($charid, 8, 4) . $hyphen
        . substr($charid, 12, 4) . $hyphen
        . substr($charid, 16, 4) . $hyphen
        . substr($charid, 20, 12)
        . chr(125);// "}"
    return $uuid;
}


function inputfilter($content)
{

    return escapeString($content);
}

/**
 * 防sql注入字符串转义
 * @param $content 要转义内容
 * @return array|string
 */
function escapeString($content)
{
    $pattern = "/(select[\s])|(insert[\s])|(update[\s])|(delete[\s])|(from[\s])|(where[\s])|(drop[\s])/i";
    if (is_array($content)) {
        foreach ($content as $key => $value) {

            if (is_array($value)) {

                for ($i = 0; $i < count($value); $i++) {
                    //$content[$key][$i] = htmlencode(addslashes(trim($value[$i])));
                    $content[$key][$i] = htmlentities(addslashes(trim($value[$i])), ENT_QUOTES, "UTF-8");
                    if (preg_match($pattern, $content[$key][$i])) {
                        $content[$key][$i] = '';
                    }
                }

            } else {

                //$content[$key] = htmlencode(addslashes(trim($value)));
                $content[$key] = htmlentities(addslashes(trim($value)), ENT_QUOTES, "UTF-8");
                if (preg_match($pattern, $content[$key])) {
                    $content[$key] = '';
                }

            }

        }
    } else {
        //$content = htmlencode(addslashes(trim($content)));
        $content = htmlentities(addslashes(trim($content)), ENT_QUOTES, "UTF-8");
        if (preg_match($pattern, $content)) {
            $content = '';
        }
    }
    return $content;
}


/**
 * 安全过滤函数
 *
 * @param $string
 * @return string
 */
function safe_replace($string)
{
    $string = str_replace('%20', '', $string);
    $string = str_replace('%27', '', $string);
    $string = str_replace('%2527', '', $string);
    $string = str_replace('*', '', $string);
    $string = str_replace('"', '&quot;', $string);
    $string = str_replace("'", '', $string);
    $string = str_replace('"', '', $string);
    $string = str_replace(';', '', $string);
    $string = str_replace('<', '&lt;', $string);
    $string = str_replace('>', '&gt;', $string);
    $string = str_replace("{", '', $string);
    $string = str_replace('}', '', $string);
    $string = str_replace('\\', '', $string);
    return $string;
}


/**生成随机数字
 * @param int $size
 * @return string
 */
function randChar($len = 4, $format = 'all')
{
    switch ($format) {
        case 'all'://生成包含数字和字母的验证码
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
        case 'char'://仅生成包含字母的验证码
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            break;
        case 'upper':
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            break;
        case 'lower':
            $chars = 'abcdefghijklmnopqrstuvwxyz';
            break;
        case 'number'://仅生成包含数字的验证码
            $chars = '0123456789';
            break;
        default :
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            break;
    }
    $string = '';
    while (strlen($string) < $len)
        $string .= substr($chars, (mt_rand() % strlen($chars)), 1);
    return $string;

}

/**生成验证码图片
 * @param string $code
 * @param int $width
 * @param int $height
 * @param int $linecount
 * @return bool
 */
function vercode($code = '', $fontsize = 20, $width = 80, $height = 25, $linecount = 12)
{
    if (empty($code) || !isset($code)) {
        return false;
    }

    request('session.vcode', $code);

    $img = imagecreatetruecolor($width, $height);
    $black = imagecolorallocate($img, 0x00, 0x00, 0x00);
    $green = imagecolorallocate($img, 0x00, 0xFF, 0x00);
    $white = imagecolorallocate($img, 0xFF, 0xFF, 0xFF);
    $red = imagecolorallocate($img, 0xFF, 0x00, 0x00);
    $blue = imagecolorallocate($img, 0x00, 0x00, 0xFF);

    $crand = rand(0, 4);
    $bgcolor = $crand == 1 ? $white : ($crand == 2 ? $green : ($crand == 3 ? $black : ($crand == 4 ? $blue : $red)));
    $fontcolor = $crand == 1 ? $red : ($crand == 2 ? $black : ($crand == 3 ? $white : ($crand == 4 ? $white : $white)));
    $lincolor = $crand == 1 ? $white : ($crand == 2 ? $blue : ($crand == 3 ? $green : ($crand == 4 ? $black : $red)));
    imagefill($img, 0, 0, $bgcolor);

    imagettftext($img, $fontsize, rand(-10, 10), rand(0, $width / 3), rand(0, $height / 3) + 20, $fontcolor, ROOT . '/public/assets/fonts/arial.ttf', $code);
    //imagestring($img, 5, rand(0,$width/3), rand(0,$height/3), $code, $fontcolor);
    //加入噪点干扰
    for ($i = 0; $i < $linecount; $i++) {
        imagesetpixel($img, rand(0, $width), rand(0, $height), $black);  //imagesetpixel — 画一个单一像素，语法: bool imagesetpixel ( resource $image , int $x , int $y , int $color )
        imagesetpixel($img, rand(0, $width), rand(0, $height), $green);
        imagesetpixel($img, rand(0, $width), rand(0, $height), $white);
        imagesetpixel($img, rand(0, $width), rand(0, $height), $red);
        imageline($img, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $lincolor);
    }

    //输出验证码
    header("content-type: image/png");
    imagepng($img);  //保存图片
    imagedestroy($img);  //图像处理完成后，使用 imagedestroy() 指令销毁图像资源以释放内存，虽然该函数不是必须的，但使用它是一个好习惯。

    //return $domain_name;
}

/**
 * 返回验证码是否验证成功
 * @param string $vcodename
 * @return bool
 */
function checkvcode($vcodename = 'vcode')
{

    $vcodename = empty($vcodename) ? 'vcode' : $vcodename;

    $vcode = request('session.' . config('validata_code_session'));
    $data = request('post.');

    return $data[$vcodename] == $vcode;
}

/**
 * 发送邮件
 * */
function sendmail($to, $subject, $body, $attachment = '', $conf = [])
{
    if (empty($conf)) {
        $conf = config('mail');
    }
    $server = $conf['server'];
    $username = $conf['username'];
    $password = $conf['password'];
    $form = $conf['form'];

    $mail = new \heephp\sendmail();
    $mail->setServer($server, $username, $password);
    $mail->setFrom($form);
    $mail->setReceiver($to);
    $mail->setMailInfo($subject, $body, $attachment);
    $mail->sendMail();
}

/**
 * 生成URL路径
 * @path 路径
 */
function url($path, $parm = '',$havesuffix=true)
{

    //清除多余字符
    while (strpos($path, "//") > -1) {
        $path = str_replace("//", "/", $path);
    }

    $allpath = explode('/', $path);
    $result_url = '';

    if (strpos($path, '/') === 0) {
        $result_url = $path;
    } else {
        if (APPS) {
            $result_url = '/' . APP . '/' . CONTROLLER . '/' . $path;
        } else
            $result_url = '/' . CONTROLLER . '/' . $path;
    }

    if (is_array($parm)) {
        if (count($parm) > 0)
            $result_url .= '/' . implode('/', $parm);
    } else {
        $result_url .= '/' . $parm;
    }

    //反向匹配路由
    $result_url = route::create()->rematch($result_url);
    $result_url = rtrim ($result_url,'/');
    //增加后缀
    $format_suffix = $havesuffix ? config('format_suffix') : '';
    $format_suffix = (empty($format_suffix) ? '' : ('.' . $format_suffix));

    return $result_url . $format_suffix;
}

function config($name='',$value='')
{
    if(empty($value)) {
        $config = \heephp\config::get($name);
    }else{
        $config = \heephp\config::set($name,$value);
    }
    return $config;
}

function db()
{
    $db=null;
    $dbconfig = config('db.');

    if ($dbconfig['diver'] == 'pdo')
        $db = new \heephp\database\pdo('mysql:host=' . $dbconfig['db_host'] . ';database=' . $dbconfig['db_name'] . ';', $dbconfig['db_username'], $dbconfig['db_password']);
    else
        $db = new \heephp\database\mysqli($dbconfig['db_host'], $dbconfig['db_port'], $dbconfig['db_username'], $dbconfig['db_password'], $dbconfig['db_name'], $dbconfig['charset'], $config['pagesize']);

    return $db;
}

function model($table)
{
    $modelINSTANCE = null;
    if (APPS) {
        $fname = './../app/' . APP . '/model/' . $table . '.php';
        if (is_file($fname)) {
            $modelNAME = '\\app\\' . APP . '\\model\\' . $table;
        } else {
            $modelNAME = '\\heephp\\model';
        }
    } else {
        $fname = './../app/model/' . $table . '.php';
        if (is_file($fname)) {
            $modelNAME = '\\app\model\\' . $table;
        } else {
            $modelNAME = '\\heephp\\model';
        }
    }

    $modelINSTANCE = new $modelNAME($table);
    return $modelINSTANCE;
}

//orm
function table($table){
    $orm = new \heephp\orm\orm();
    return $orm->table($table);
}

//多语言
function lang($tag)
{

    if (config('lang.on') == false) {
        return '';
    }

    $langcach = cache('lang_' . config('lang.default'));

    if (!$langcach) {
        $lang = new \heephp\lang();
        $langcach = $lang->get();
        cache('lang_' . config('lang.default'), $langcach, 31104000);
    }

    return $langcach[$tag] ?? '';

}

//切面
function aop($name, &$parms = [])
{
    $aop = new \heephp\aop();
    $aop->invoke($name, $parms);

    if (is_array($parms)) {
        if (array_key_exists('result', $parms)) {
            return $parms['result'];
        } else
            return false;
    }
}


//视图中导入
function import($file, $vars = [])
{
    //传递变量
    foreach ($vars as $k => $v) {
        $$k = $v;
    }

    $backtrace = debug_backtrace();
    //获取引用页面的变量
    for ($i = 0; $i < count($backtrace); $i++) {

        if ($backtrace[$i]['function'] == 'fetch' && $backtrace[$i]['class'] == 'heephp\controller') {

            $pagevars = $backtrace[$i]['object']->pagevar;
            foreach ($pagevars as $item) {
                $k = array_key_first($item);
                $v = array_values($item);

                $$k = $v[0];
            }
            break;
        }

    }

    $fname = '';
    //判断是否是否使用独立目录
    $skindir = config('skin_dir');
    $skindir = empty($skindir) ? '' : ($skindir . '/');

    //判断是否使用皮肤
    $skin = config('skin');
    $skin = empty($skin) ? '' : ($skin);

    if (!empty($skindir)) {
        //如果使用了指定目录

        if (strstr($file, '/') == $file) {
            $fname = './../' . $skindir . $skin . $file;
            include $fname;
        } else {
            $currtfile = $backtrace[0]['file'];
            include dirname($currtfile) . '/' . $file;
        }

    } else if (APPS) {

        if (strstr($file, '/') == $file) {
            $fname = './../app/' . APP . '/view/' . $file;
            include $fname;
        } else {
            $currtfile = $backtrace[0]['file'];
            include dirname($currtfile) . '/' . $file;
        }
    } else {
        if (strstr($file, '/') == $file) {
            $fname = './../app/view/' . CONTROLLER . '/' . $file;
            include $fname;
        } else/*if (strpos($file,'/')>0)*/ {
            $currtfile = $backtrace[0]['file'];
            include dirname($currtfile) . '/' . $file;
        }/*
        else {
            include $file;
            return;
        }*/
    }


}

/**
 * 将时间解析为 分钟 小时 前
 * @param $time
 * @return false|string
 *
 */
function transfer_time($time)
{
    $rtime = date("m-d H:i", $time);
    $htime = date("H:i", $time);
    $time = time() - $time;
    if ($time < 60) {
        $str = '刚刚';
    } elseif ($time < 60 * 60) {
        $min = floor($time / 60);
        $str = $min . '分钟前';
    } elseif ($time < 60 * 60 * 24) {
        $h = floor($time / (60 * 60));
        $str = $h . '小时前 ' . $htime;
    } elseif ($time < 60 * 60 * 24 * 3) {
        $d = floor($time / (60 * 60 * 24));
        if ($d == 1)
            $str = '昨天 ' . $rtime;
        else
            $str = '前天 ' . $rtime;
    } else {
        $str = $rtime;
    }
    return $str;
}

//截取字符串
function sstr($str, $max)
{
    if (mb_strlen($str) > $max - 2) {
        return mb_substr($str, 0, $max - 2) . '..';
    } else
        return $str;
}


function htmlencode($fString)
{
    if ($fString != "") {
        $fString = str_replace('>', '&gt;', $fString);
        $fString = str_replace('<', '&lt;', $fString);
        $fString = str_replace(chr(32), '&nbsp;', $fString);
        $fString = str_replace(chr(13), ' ', $fString);
        $fString = str_replace(chr(10) & chr(10), '<br>', $fString);
        $fString = str_replace(chr(10), '<BR>', $fString);
    }
    return $fString;
}

function htmldecode($fString)
{
    if ($fString != "") {
        $fString = str_replace("&gt;", ">", $fString);
        $fString = str_replace("&lt;", "<", $fString);
        $fString = str_replace("&nbsp;", chr(32), $fString);
        $fString = str_replace("", chr(13), $fString);
        $fString = str_replace("<br>", chr(10) & chr(10), $fString);
        $fString = str_replace("<BR>", chr(10), $fString);
    }
    return $fString;
}

/**
 * 遍历目录
 * @param $path 目录路径
 * @param callable $callback
 */
function foreach_dir($path, callable $callback)
{
    //如果是目录则继续
    if (is_dir($path)) {
        //扫描一个文件夹内的所有文件夹和文件并返回数组
        $p = scandir($path);
        foreach ($p as $val) {
            if ($val != "." && $val != "..") {
                call_user_func($callback, $val, $path);
            }
        }
    }
}

/**
 * 获取图片的Base64编码(不支持url)
 * @param $img_file 传入本地图片地址
 * @return string
 */
function imgToBase64($img_file) {

    $img_base64 = '';
    if (file_exists($img_file)) {
        $app_img_file = $img_file; // 图片路径
        $img_info = getimagesize($app_img_file); // 取得图片的大小，类型等

        //echo '<pre>' . print_r($img_info, true) . '</pre><br>';
        $fp = fopen($app_img_file, "r"); // 图片是否可读权限

        if ($fp) {
            $filesize = filesize($app_img_file);
            $content = fread($fp, $filesize);
            $file_content = chunk_split(base64_encode($content)); // base64编码
            switch ($img_info[2]) {           //判读图片类型
                case 1: $img_type = "gif";
                    break;
                case 2: $img_type = "jpg";
                    break;
                case 3: $img_type = "png";
                    break;
            }

            $img_base64 = 'data:image/' . $img_type . ';base64,' . $file_content;//合成图片的base64编码

        }
        fclose($fp);
    }

    return $img_base64; //返回图片的base64
}


/**
 * 清空空格和换行
 * @param $str
 */
function space($str)
{
    $search = array('    ', '   ', '  ', '  ', '  ', "\n", "\r", "\t");
    $replace = array(' ', ' ', ' ', ' ', ' ', '', '', '');
    return str_replace($search, $replace, $str);
}

function widget($path,$parm)
{
    $path = explode('/', $path);
    if (APPS) {
        //如果以/开头
        if ($path & '/' == '/' && count($path) > 3) {
            $clsname = 'app/' . $path[1] . '/' . $path[2];
            $cls = new $clsname();
            echo $cls->$path[3]($parm);
        } elseif ($path & '/' == '/' && count($path) > 2) {
            $clsname = 'app/' . APP . '/' . $path[1];
            $cls = new $clsname();
            echo $cls->$path[2]($parm);
        } elseif ($path & '/' == '/') {
            $clsname = 'app/' . APP . '/' . CONTROLLER;
            $cls = new $clsname();
            echo $cls->$path[1]($parm);
        } else {
            $clsname = 'app/' . APP . '/' . CONTROLLER;
            $cls = new $clsname();
            echo $cls->$path[0]($parm);
        }
    } else {
        //如果以/开头
        if ($path & '/' == '/' && count($path) > 2) {
            $clsname = 'app/' . $path[1] ;
            $cls = new $clsname();
            echo $cls->$path[2]($parm);

        } elseif( count($path) > 2) {
            $clsname = 'app/' .$path[0];
            $cls = new $clsname();
            echo $cls->$path[1]($parm);
        }
    }
}

 function json($data){
    return json_encode($data);
}

spl_autoload_register(function ($class_name) {

    //\heephp\logger::warn('自动加载类：' . $class_name);

    $class_name = str_replace('\\', '/', $class_name);
    $file = './../' . $class_name . '.php';

    if (is_file($file)) {
        include_once($file) ;
        return;
    } else {
        foreach_dir('./../vendor/', function ($val, $path) use ($class_name) {
            $file = './../vendor/' . $val . '/' . $class_name . '.php';
            if (is_file($file)) {
                include_once($file) ;
                return;
            }
        });

    }

});