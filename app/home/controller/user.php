<?php
namespace app\home\controller;
use app\home\model\category;
use  heephp\controller;
use heephp\formbulider;
use heephp\sysExcption;
use heephp\wherebuild;

class user extends base
{


    public function __construct()
    {
        parent::__construct();

        $this->assign('islogin',false);
        if(!in_array(METHOD,['login','login_action','reg','reg_action','vcode'])){
            if(!$this->cklogin()) {
                return $this->redirect(url('login'));
                exit();
            }else
                $this->userid = request($this->session_id_str);
        }

    }



    public function login()
    {

        return $this->fetch();
    }

    public function login_action(){
        if(!check_crsf()){
            return $this->error('表单验证失败！');
        }

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
        if(!check_crsf()){
            return $this->error('表单验证失败！');
        }

        if (conf('is_vcode') && !checkvcode()) {
            return $this->error('验证码错误！');
        }

        $data = request('post.');
        $username = $data['username'];
        $password = $data['password'];
        $cpassword = $data['cfmpassword'];
        unset($data['crsf']);

        if(empty($username)||empty($password)){
            return $this->error('请输入用户名或密码！');
        }
        if($password!=$cpassword){
            return $this->error('两次输入的密码不同！');
        }
        //$data['password'] = $data['password'];
        $data['users_group_id']=conf('newusergroup');
        unset($data['cfmpassword']);
        unset($data['vcode']);

        $users = model('users');
        $id = $users->insert($data);
        if($id){
            return $this->success('恭喜您，注册成功！',url('login'),10);
        }else{
            return $this->error('抱歉，注册失败！');
        }
    }

    public function vcode(){
        $char=randChar(conf('vcode_num'),'number');
        vercode($char,conf('vcode_fontsize'),conf('vcode_width'),conf('vcode_heigh'));
    }

    public function usercenter(){
        $this->assign('ugname',request($this->session_users_group_name_str));
        return $this->fetch();
    }

    public function edit(){
        $m = model('users')->get($this->userid);
        $this->assign('m',$m);

        $countries = model('country')->select();
        $this->assign('countries',$countries);
        return $this->fetch();
    }
    public function save(){
        if(!check_crsf()){
            return $this->error('表单验证失败！');
        }

        $d=request('post.');
        unset($d['crsf']);

        $ef = model('users')->where('users_id='.$this->userid)->update($d);
        if($ef){
            return $this->success('修改资料成功！',url('edit'));
        }else
            return $this->error('修改资料失败！');

    }
    function uploadheader(){

        $data= request('post.');
        $fsize = conf('upload_size')*1024;
        $fdir = 'upload/'.date('Ymd',time()).'/';
        $info=uploadfile('header',['jpg','png','gif'],$fsize,$fdir);
        if(empty($info['error'])&&!empty($info['name'])){

            //删除原来的文件
            $user= model('users')->get($data['users_id']);
            if(!empty($user['header'])){
                @unlink(ROOT.'\\public'.$user['header']);
            }

            $db=db();
            $result = $db->update('users',['header'=>'/'.$fdir.'/'.$info['name']],['users_id'=>$data['users_id']]);
            $header = '/'.$fdir.'/'.$info['name'];
            request($this->session_users_header_str,$header);

            if($result){
                return json(['msg'=>$header,'state'=>'ok']);
            }else{
                return json(['state'=>'error','msg'=>'数据库更新失败']);
            }

        }else{
            return json(['state'=>'error','msg'=>$info['error']]);
        }

    }

    function inbox(){
        $m=model('message');
        $mlist=$m->where('receiver_users_id='.$this->userid)->order('create_time desc')->page();
        $m->sender();
        $m->receiver();
        $this->assign('list',$mlist);
        $this->assign('pager',$m->pager['show']);
        return $this->fetch();
    }

    function msg($id){
        $msg=model('message');
        $m=$msg->where('receiver_users_id='.$this->userid.' and message_id='.$id)->find();
        $msg->sender();
        $msg->receiver();
        $msg->setField('isread',1);
        $this->assign('m',$msg->data);
        return $this->fetch();
    }

    function sendmsg($re=''){

        $this->assign('re',$re);
        return $this->fetch();
    }

    function sendmsg_action()
    {
        if(!check_crsf()){
            return $this->error('表单验证失败！');
        }
        if (conf('is_vcode') && !checkvcode()) {
            return $this->error('验证码错误！');
        }

        $d = request('post.');
        $receivers = explode(',', $d['receiver']);
        unset($d['receiver']);
        unset($d['vcode']);
        $msg = model('message');
        $users = model('users');
        $fails=[];
        foreach ($receivers as $r) {
            $ruid = $users->where("`username`='$r'")->getByusers_id();

            //如果是自己则不发送
            if($ruid==$this->userid||empty($ruid)){
                $fails[]=$r;
                continue;
            }
            //发送
            if(!empty($ruid)) {
                $d['receiver_users_id'] = $ruid;
                $result = $msg->insert($d);
                //如果发送失败则记录
                if(!$result)
                    $fails[] = $r;
            }
        }
        return $this->success('发送成功，其中以下用户发送失败：'.implode(',',$fails),url('inbox'),10);
    }

    /*function delmsg($id){

        $msg = model('message');
        $ef = $msg->where('message_id='.$id.' and member_id='.$this->userid)->delete();
        if($ef){
            return $this->success('删除成功！',url('inbox'));
        }else
            return $this->error('删除失败！');
    }*/

    function publish(){

        $category = model('category');
        $category->whereEmpty('parent_id')->select();
        $category->child();
        $this->assign('plist',$category->data);

        return $this->fetch('editart');
    }

    function manager($categoryid='')
    {
        $wsql = 'create_users_id=' . $this->userid;
        if ($categoryid != '')
            $wsql = " and category_id=$categoryid";

        $article = model('article');
        $article->where($wsql)->order("recommend desc,create_time desc")->page();
        $article->category();
        $article->create_user();
        $this->assign('list', $article->data);
        $this->assign('pager', $article->pager['show']);

        return $this->fetch();
    }

    function saveart(){

        if(!check_crsf()){
            return $this->error('表单验证失败！');
        }

        $data = request('post.');
        unset($data['crsf']);
        $data['author']=request($this->session_name_str);

        $article = model('article');
        if (!empty($data['article_id'])) {
            $result = $article->update($data);
        } else {
            $data['create_users_id']=$this->userid;
            $result = $article->insert($data);
        }
        if ($result) {
            return $this->success('保存成功！', url('manager'));
        } else
            return $this->error('保存失败！');
    }

    function editart($id){

        $category = model('category');
        $category->whereEmpty('parent_id')->select();
        $category->child();
        $this->assign('plist',$category->data);

        $article = model('article');
        $art = $article->get($id);
        $this->assign('m',$art);

        return $this->fetch();
    }

    function delart($id){
        $article = model('article');
        $isdel = $article->where("article_id=$id and users_id=$this->userid")->delete();
        if($isdel){
            return $this->success('删除成功！',url('manager'));
        }else
            return $this->error('删除失败！');
    }

    function orders(){
        $so=model('order');
        $so->where('create_users_id='.$this->userid)->order("create_time desc")->page();

        $this->assign('list',$so->data);
        $this->assign('pager',$so->pager['show']);

        return $this->fetch();
    }

    function orderstate($id,$state){

        if(!in_array($state,[-1])){
            return $this->error('状态错误！');
        }

        $so=model('order');
        $is = $so->where('create_users_id='.$this->userid." and order_id='$id'")->setField('state',$state);
        if($is){
            $this->success('订单状态更改成功！',url('orders'));
        }else
            $this->success('订单状态更改失败！',url('orders'));

    }

    function orddetail($id){
        $so=model('order');
        $so->get($id);
        $so->detail();
        $this->assign('m',$so->data);
        return $this->fetch();
    }

    function pay($id){
        $so=model('order');
        $m = $so->get($id);
        $this->assign('m',$m);
        return $this->fetch();
    }

    function pingjia($id){
        $so=model('order');
        return $this->fetch();
    }

    function tuikuan($id){
        $so=model('order');
        return $this->fetch();
    }

    function delorder($id){
        $so=model('order');
        $is = $so->where('create_users_id='.$this->userid." and order_id='$id'")->softdel(true)->delete();
        if($is){
            $this->success('删除订单成功！',url('orders'));
        }else
            $this->success('删除订单失败！');
    }

}