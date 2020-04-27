<?php

namespace app\admin\controller;

use heephp\validata;

class users extends adminBase
{
    function manager(){
        $users = model('users');
        $list =$users->page();
        $users->users_group();//var_dump($users->data);
        $this->assign('list',$users->data);
        $this->assign('pager',$users->pager['show']);
        return $this->fetch();
    }

    function add(){

        $country = model('country');
        $countries = $country->select();
        $this->assign('countries',$countries);

        $ugroup = model('users_group');
        $ugroups = $ugroup->select();
        $this->assign('ugroups',$ugroups);

        return $this->fetch('edit');
    }

    function edit($id){

        $users = model('users');

        $country = model('country');
        $countries = $country->select();
        $this->assign('countries',$countries);

        $ugroup = model('users_group');
        $ugroups = $ugroup->select();
        $this->assign('ugroups',$ugroups);

        $m=$users->get($id);
        $users->users_group();
        $this->assign('m',$users->data);
        return $this->fetch();
    }

    function delete($id){
        $users = model('users');
        $re = $users->delete($id);
        if($re){
            return $this->success('删除成功！',url('manager'));
        }else
            return $this->error('删除失败');
    }

    function save(){
        $data=request('post.');
        if(empty(trim($data['password']))){
            unset($data['password']);
        }else{
            $validata = new validata($data['password']);
            if(!$validata->must()||!$validata->alphaNumDash(6)){
                validata::set_error(['message'=>'密码不能为空，请输入6位以上字母数字下划线组合！','field'=>'password','title'=>'验证错误']);
                validata::showerror();
                exit;
            }
        }
        $users = model('users');
        if(!empty($data['users_id'])){
            $result = $users->update($data);
        }else{
            $result = $users->insert($data);
        }
        if($result){
            return $this->success('保存成功！',url('manager'));
        }else
            return $this->error('保存失败！');
    }

    function uploadheader(){
        $data= request('post.');
        $fsize = conf('upload_size')*1024;
        $fdir = 'upload/'.date('Ymd',time());
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
                return $this->json(['msg'=>$header,'state'=>'ok']);
            }else{
                return $this->json(['state'=>'error','msg'=>'数据库更新失败']);
            }

        }else{
            return $this->json(['state'=>'error','msg'=>$info['error']]);
        }

    }

}