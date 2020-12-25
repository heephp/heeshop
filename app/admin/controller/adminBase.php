<?php

namespace app\admin\controller;

use heephp\controller;
use heephp\model;


class adminBase extends controller {

    protected $session_id_str='session.admin_user_id';
    protected $session_name_str='session.admin_user_name';
    protected $session_users_group_id_str='session.admin_user_group_id';
    protected $session_users_group_name_str='session.admin_user_group_name';
    protected $session_users_header_str='session.admin_user_header';
    protected $session_users_email_str='session.admin_user_email';


    //是否跳过验证登录
    protected $passauth = false;
    //超级管理员
    protected $superadmin='超级管理员';

    //用户组权限列表的缓存名称前缀
    protected $cache_users_group_sys_resources_list = '__users_group_sys_resources_list_';

    function __construct()
    {
        parent::__construct();

        if(!$this->passauth) {

            $this->logincheck();

            if (!$this->auth()){

                echo $this->error('您没有'.'/'.CONTROLLER.'/'.METHOD.'的操作权限');
                exit();
            }

            $this->get_message_list();

            $this->get_menus_list();

        }

    }

    protected function logincheck(){

        $user_id=request($this->session_id_str);
        $user_name=request($this->session_name_str);
        $user_group_id=request($this->session_users_group_id_str);
//echo request($this->session_users_group_name_str);exit;
        if(empty($user_id)||empty($user_name)||empty($user_group_id)){
            return $this->redirect('index/login?r='.urlencode($_SERVER['REQUEST_URI']));
        }

        $this->assign('user_id',$user_id);
        $this->assign('user_name',$user_name);
        $this->assign('user_group_id',$user_group_id);
        $this->assign('user_header',request($this->session_users_header_str));
        $this->assign('user_email',request($this->session_users_email_str));
        $this->assign('user_group_name',request($this->session_users_group_name_str));

    }

    protected function auth(){


        $action = '/'.CONTROLLER.'/'.METHOD;
        $user_group_id=request($this->session_users_group_id_str);

        //如果是超级管理员 权限通过
        $ug = model('users_group');
        $ugname = $ug->where("`$ug->key`=$user_group_id")->getByname();
        if($ugname==$this->superadmin){
            return true;
        }

        //从缓存中读取用户组权限列表
        $ugrlist = cache($this->cache_users_group_sys_resources_list.$user_group_id);

        //如果缓存中不存在 从数据库中读取 后保存缓存
        if(empty($ugrlist)) {

            $ug->get(request($this->session_users_group_id_str));
            $ug->sys_resources();
            $ugrlist = $ug->data['sys_resources'];
            cache($this->cache_users_group_sys_resources_list.$user_group_id,$ugrlist);

        }

        //判断当前请求是否存在
        if(empty($ugrlist)) {
            return false;
        }else{
            //判断当前请求是否存在
            foreach ($ugrlist as $item) {
                if ($item['path'] == $action) {
                    return true;
                }
            }
        }


    }

    /*
     * 获取用户消息列表
     * */
    private function get_message_list(){

        $message = model('message');
        $sql = $message->where("`isread`=0 and `receiver_users_id`='".request($this->session_id_str)."'")->order('create_time desc')->limit(5)->select();
        $this->assign('message_list',$message->data);

    }

    private function get_menus_list(){

        $menus = model('menus');
        $menus->whereEmpty("parent_id")->order('ord asc')->select();
        $menus->child();

        $this->assign('menus',$menus->data);

    }




}