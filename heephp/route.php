<?php
namespace heephp;
class route
{
    private static $_route = null;
    //普通网址路由规则
    private static $routes = [];
    //域名路由规则
    private static $route_domains = [];
    //文件路由规则
    private static $route_files = [];
    //跳转路由规则
    private static $route_redirects = [];


    private function __construct()
    {
        $rfile = './../app/route.php';
        if (is_file($rfile)) {
            require_once $rfile;
        }
    }

    public static function create()
    {
        if (self::$_route == null)
            self::$_route = new route();
        return self::$_route;
    }

    /**
     * 将规则匹配到 控制器 或 控制器方法 或 回调函数
     * @param $rule
     * @param $path
     */
    public static function get($rule, $path='')
    {
        if (is_array($rule)) {
            foreach ($rule as $k => $v) {
                self::$routes[$k] = $v;
            }
            return;
        }

        if (empty($path))
            throw new sysExcption('路由路径不能为空');

        self::$routes[$rule] = $path;
    }

    /**
     * 将目录的所有文件路由到指定控制器
     * @param $dir  目录名
     * @param $path  控制器
     */
    public static function dir($dir,$path){

        if (is_array($dir)) {
            throw new sysExcption('路由目录只能为字符串');
            return;
        }

        self::_dir(ROOT.$dir,$path);

        //var_dump(self::$routes);
    }

    private static function _dir($dir,$path,$pre=''){

        foreach_dir($dir,function ($dname,$dpath) use ($dir,$path,$pre){

            if(is_file($dpath.'/'.$dname)) {
                $dname = pathinfo($dname, PATHINFO_FILENAME);
                self::$routes[$pre.$dname] = $path . (empty($pre)?'/':'_') . $dname;
            }else if(strtolower($dname)!='layout'){

                self::_dir($dpath.'/'.$dname,$path.'/'.$dname,$dname.'_');
            }

        });
    }

    /**
     * 将域名规则匹配到 控制器 或 控制器方法 或 回调函数
     * @param $rule
     * @param $path
     */
    public static function domain($rule, $path='')
    {
        if (is_array($rule)) {
            foreach ($rule as $k => $v) {
                self::$route_domains[$k] = $v;
            }
            return;
        }

        if (empty($path))
            throw new sysExcption('域名路由路径不能为空');

        self::$route_domains[$rule] = $path;
    }

    /**
     * 将规则匹配到 文件
     * @param $rule
     * @param $path
     */
    public static function file($rule, $file)
    {
        self::$route_files[$rule] = $file;
    }

    /**
     * 将规则匹配到 文件
     * @param $rule
     * @param $path
     */
    public static function redirect($rule, $url)
    {
        self::$route_redirects[$rule] = $url;
    }

    /**
     * 匹配到控制器 或 方法
     * @parm url 当前url匹配的路由
     * @param rs 要匹配的规则
     * @return 没有匹配的路由返回false
     */
    private function match_url_to_routes($url, $rs)
    {
        $xstart = strpos($url, '/');
        $url = ($xstart == 0) ? substr($url, $xstart + 1) : $url;

        foreach ($rs as $k => $v) {
            $k = ltrim($k, '/');
            $k = '^' . $k;
            $k = str_replace('/', '\\/', $k);
            $single = preg_match('/' . $k . '/i', $url);
            if ($single) {
                return preg_replace('/' . $k . '/i', $v, $url);
            }
        }
        return false;
    }

    /**
     * 反向匹配网址
     * @param $url
     */
    public function rematch($url)
    {
        $url = $this->re_domain($url);
        //反向匹配Path
        $rs = self::$routes;

        $rpath = '';
        foreach ($rs as $k => $v) {
            $v = '^' . $v;
            $v = str_replace('/', "\\/", $v);
            $single = preg_match('/' . $v . '/i', $url);
            if ($single) {
                $k = str_replace('$', '', $k);
                $url = preg_replace('/^' . $v . '/i', $k, $url, 1);
                return $url;
            }
        }

        return $url;

    }

    /**
     * 域名反向解析
     * @param $url
     * @return string
     */
    private function re_domain($url)
    {
        //获取请求域名信息
        $urlinfo = $this->urlparse();
        $domain = $urlinfo['host'];
        $cdoms = explode('.', $domain);
        $cdomscount = count($cdoms);

        $restr = '';
        //匹配域名
        $domains = self::$route_domains;
        foreach ($domains as $rule => $dom) {
            $rs = explode('.', $rule);

            if (($url & $dom) === $dom) {
                if($dom!='/')
                $url = str_replace($dom, '', $url);

                //如果是泛域名解析
                if ($rs[0] == '*') {
                    //保存泛域名名字
                    session('domain_name', $rs[0]);
                    unset($rs[0]);
                    unset($cdoms[0]);
                    $cdom = implode('.', $cdoms);
                    $rs = implode('.', $rs);
                    if ($cdom == $rs) {

                        return ($this->is_https() ? 'https://' : 'http://') . $domain . '/' . $url;

                    }

                } elseif ($domain != $rule)
                    //如果不是泛域名 且 不是当前访问域名
                    return ($this->is_https() ? 'https://' : 'http://') . $rule . '/' . $url;

            }

        }


        return $url;//(substr($url, 0, 1) === '/') ? $url : ($url . '/');
    }

    /**
     * 注册pagetag以过滤url中的page参数
     */
    public function reg_pagetag($tag)
    {
        $_pagetag = request('session.page_parms_tags');

        if (!is_array($_pagetag)) {
            $_pagetag[] = $tag;
            request('session.page_parms_tags', $_pagetag);
            return;
        }

        if (!in_array($tag, $_pagetag)) {
            $_pagetag[] = $tag;
            request('session.page_parms_tags', $_pagetag);
        }

    }

    public function get_pagetag()
    {
        $_pagetag = request('session.page_parms_tags');
        return $_pagetag;
    }

    /**
     * 解析URL并获取域名信息
     * @return mixed
     */
    private function urlparse()
    {
        $url = $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
        $urlinfo = parse_url($url);


        //将querystring 的值拼接入path
        $querys = explode('&', $urlinfo['query']);
        foreach ($querys as $qstr) {
            $sq = explode('=', $qstr);
            if (!empty($sq[1])) {
                $urlinfo['path'] .= '/' . $sq[1];
            }
        }

        //清除多余字符
        while (strpos($urlinfo['path'], "//") > -1) {
            $urlinfo['path'] = str_replace("//", "/", $urlinfo['path']);
        }
        //删除文件后缀
        $format_suffix = config('format_suffix');
        $splitpoint = substr($urlinfo['path'], strlen($urlinfo['path']) - strlen($format_suffix) - 1, 1);
        if (!empty($format_suffix) && $splitpoint == '.') {
            $urlinfo['path'] = substr($urlinfo['path'], 0, strlen($urlinfo['path']) - strlen($format_suffix) - 1);
        }
        return $urlinfo;
    }


    /**
     * 匹配域名
     */
    public function match_domain()
    {
        //获取请求域名信息
        $urlinfo = $this->urlparse();
        $domain = $urlinfo['host'];
        $cdoms = explode('.', $domain);
        $cdomscount = count($cdoms);

        //匹配域名
        $domains = self::$route_domains;
        foreach ($domains as $rule => $dom) {
            $rs = explode('.', $rule);
            if (count($rs) == $cdomscount && $cdomscount > 2) {
                if ($rule == $domain) {
                    $path = $this->urlparse();
                    return rtrim($dom, '/') . $path['path'];
                } elseif ($rs[0] == '*') {
                    unset($rs[0]);
                    unset($cdoms[0]);
                    $cdom = implode('.', $cdoms);
                    $rs = implode('.', $rs);
                    if ($cdom == $rs) {
                        $path = $this->urlparse();
                        return rtrim($dom, '/') . $path['path'];
                    }
                }
            }
        }
        return false;
    }

    /**
     * 匹配网址
     */
    public function match_url()
    {

        $urlinfo = $this->urlparse();

        //检测路由是否存在 如果存在则替换为实际控制器方法
        $route = $this->match_url_to_routes($urlinfo['path'], self::$routes);
        if ($route) {

            if (is_callable($route))
                return $route;

            $urlinfo['path'] = $route;

        }

        $urlinfos = explode('/', $urlinfo['path']);

        //过滤page等参数
        //-----------------------
        $pagetags = $this->get_pagetag();
        if (is_array($pagetags)) {
            foreach ($pagetags as $p) {
                for ($i = 3; $i > 0; $i--) {
                    if (strstr($urlinfos[$i], $p . '_') == $urlinfos[$i]) {
                        unset($urlinfos[$i]);
                    }
                }
            }
        }
        //-------------------------

        return $urlinfos;
    }

    /**
     * 匹配到文件
     */
    public function match_file()
    {
        $urlinfo = $this->urlparse();
        $route = $this->match_url_to_routes($urlinfo['path'], self::$route_files);
        if ($route) {
            return $route;
        }
        return false;
    }

    /**
     * 匹配到跳转
     */
    public function match_redirect()
    {
        $urlinfo = $this->urlparse();
        $route = $this->match_url_to_routes($urlinfo['path'], self::$route_redirects);
        if ($route) {
            return $route;
        }
        return false;
    }

    /**
     * 从URL中获取 APP CONTROLLER METHOD PARMS
     * 从URL中获取详细
     * @param $urlinfos
     */
    public function get_detail_form_urlinfos($urlinfos)
    {
        $parms = [];
        if (APPS) {
            $app = $urlinfos[1];
            $controller = $urlinfos[2];
            $method = $urlinfos[3];
            for ($i = 4; $i < count($urlinfos); $i++) {
                array_push($parms, $urlinfos[$i]);
            }
        } else {
            $controller = $urlinfos[1];
            $method = $urlinfos[2];
            for ($i = 3; $i < count($urlinfos); $i++) {
                array_push($parms, $urlinfos[$i]);
            }
        }

        //识别扩展名
        if(strpos($method,'.')>-1) {
            $ms = explode('.', $method);
            if($ms[count($ms)-1]==config('format_suffix')){
                $method = substr($method,0,strlen($method)-strlen($ms[count($ms)-1])-1);
            }
        }

        //如果为空则选择默认的控制器方法
        $re['app'] = APPS ? (empty($app) ? config('default_app') : $app) : '';
        $re['controller'] = empty($controller) ? config('default_controller') : $controller;
        $re['method'] = empty($method) ? config('default_method') : $method;
        $re['parms'] = $parms;

        return $re;
    }


    /**
     * PHP判断当前协议是否为HTTPS
     */
    private function is_https()
    {
        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            return true;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            return true;
        } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            return true;
        }
        return false;

    }
}