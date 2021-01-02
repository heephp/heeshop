<?php
namespace app\home\controller;
use app\home\model\category;
use  heephp\controller;
use heephp\formbulider;
use heephp\sysExcption;
use heephp\wherebuild;

class user extends base
{
    protected $session_id_str='session.user_id';
    protected $session_name_str='session.user_name';
    protected $session_users_group_id_str='session.user_group_id';
    protected $session_users_group_name_str='session.user_group_name';
    protected $session_users_header_str='session.user_header';
    protected $session_users_email_str='session.user_email';
    protected $session_users_num_str='session.user_login_num';

    public function __construct()
    {
        parent::__construct();

        $this->assign('islogin',false);
        if(!in_array(METHOD,['login','login_action','reg','reg_action','vcode'])){
            if(!$this->cklogin()) {
                return $this->redirect(url('login'));
                exit();
            }
        }

    }

    private function cklogin()
    {
        //如果登录
        if(!empty(request($this->session_id_str))&&!empty(request($this->session_name_str))){
            $this->assign('user_id',request($this->session_id_str));
            $this->assign('user_name',request($this->session_name_str));
            $this->assign('usergroup',request($this->session_users_group_name_str));
            $this->assign('usergroup_id',request($this->session_users_group_id_str));
            $this->assign('user_header',request($this->session_users_header_str));
            $this->assign('user_email',request($this->session_users_email_str));
            $this->assign('user_loginnum',request($this->session_users_num_str));
            $this->assign('islogin',true);
            return true;
        }
        return false;
    }

    public function login()
    {

        return $this->fetch();
    }

    public function login_action(){
        if (conf('is_vcode') && !checkvcode()) {
            return $this->error('验证码错误！');
        }

        $data = request('post.');
        $username = $data['username'];
        $password = $data['password'];
        $r = $data['r'];
        if(empty($username)||empty($password)){
            return $this->error('请输入用户名或密码！');
        }

        $users = model('users');
        $m = $users->where("`username`='$username' and `password`='" . md5($password) . "'")->find();
        if (!empty($m)) {
            $users->users_group();
            /*if(empty($users->data['users_group']['isadmin'])){
                return $this->error('您不是管理员，无法登录！');
            }*/
            $users->where("users_id=".$m['users_id'])->setInc('num',1);
            request($this->session_id_str, $m['users_id']);
            request($this->session_name_str, $m['username']);
            request($this->session_users_group_id_str, $m['users_group_id']);
            request($this->session_users_group_name_str, $users->data['users_group']['name']);
            request($this->session_users_email_str, $m['email']);
            request($this->session_users_num_str, $m['num']++);
            request($this->session_users_header_str, $m['header']);
            return $this->redirect(empty($r)?'usercenter':$r);
        } else {
            return $this->error('用户名或密码错误！');
        }
    }


    function logout(){
        session_destroy();
        return $this->redirect('login');

    }

    public function reg(){

        return $this->fetch();
    }

    public function reg_action(){
        if (conf('is_vcode') && !checkvcode()) {
            return $this->error('验证码错误！');
        }

        $data = request('post.');
        $username = $data['username'];
        $password = $data['password'];
        $cpassword = $data['cfmpassword'];

        if(empty($username)||empty($password)){
            return $this->error('请输入用户名或密码！');
        }
        if($password!=$cpassword){
            return $this->error('两次输入的密码不同！');
        }
        $data['password'] = md5($data['password']);
        $data['users_group_id']=conf('newusergroup');
        unset($data['cfmpassword']);
        unset($data['vcode']);

        $users = model('users');
        $id = $users->insert($data);
        if($id){
            return $this->success('恭喜您，注册成功！',url('login'));
        }else{
            return $this->error('抱歉，注册失败！');
        }
    }

    public function vcode(){
        $char=randChar(conf('vcode_num'));
        vercode($char,conf('vcode_fontsize'),conf('vcode_width'),conf('vcode_heigh'));
    }

    public function usercenter(){
        return $this->fetch();
    }

}