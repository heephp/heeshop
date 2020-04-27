<?php
namespace app\admin\controller;

class users_group extends adminBase{

    public function manager(){
        $ug = model('users_group');
        $list =$ug->page();
        $ug->create_user();
        $this->assign('list',$ug->data);
        $this->assign('pager',$ug->pager['show']);
        return $this->fetch();
    }

    function add(){
        return $this->fetch('edit');
    }

    public function edit($id){
        $ug = model('users_group');
        $m=$ug->get($id);

        //超级管理员不能被编辑
        if($this->superadmin==$m['name']){
            return $this->error($this->superadmin.'不能被编辑');
        }

        $this->assign('m',$m);
        return $this->fetch();
    }

    function delete($id){
        $ug = model('users_group');

        //超级管理员不能被删除
        $m=$ug->get($id);
        if($this->superadmin==$m['name']){
            return $this->error($this->superadmin.'不能被编辑');
        }

        //用户组存在用户不能被删除
        $users=model('users');
        $ulist = $users->getByusers_group_id('users_group_id='.$id);
        if(is_array($ulist)&&count($ulist)>0){
            return $this->error('当前用户组存在用户，不能被删除');
        }

        $re = $ug->delete($id);
        if($re){
            cache()->clear();
            return $this->success('删除成功！',url('manager'));
        }else
            return $this->error('删除失败');
    }

    public function save(){
        $data=request('post.');
        $ug = model('users_group');

        $data['isadmin']=$data['isadmin']??0;
        $data['create_users_id']=request($this->session_id_str);
        if(!empty($data['users_group_id'])){
            $result = $ug->update($data);
        }else{
            $result = $ug->insert($data);
        }
        if($result){
            cache()->clear();
            return $this->success('保存成功！',url('manager'));
        }else
            return $this->error('保存失败！');
    }


    /*用户组权限管理*/
    function sys_resource($ugid=0){

        $ug=model('users_group');
        $ug->select("`name`<>'$this->superadmin' and isadmin=1");
        $this->assign('uglist',$ug->data);

        $res = model('sys_resources');
        $res->select("parent_id<1 or parent_id IS NULL or parent_id=''");
        $res->child();
        $this->assign('resplist',$res->data);

        if($ugid>0){
            $ug->select($ug->key.'='.$ugid);
            $ug->sys_resources();
            foreach ($ug->data as $item) {


                    $sids=[];
                    if(is_array($item['sys_resources']))
                        $sids = array_column($item['sys_resources'],'sys_resources_id');

                    $this->assign('ugres',$sids);


            }

        }

        $this->assign('ugid',$ugid);
        return $this->fetch();
    }

    /*
     * 保存用户权限
     * */
    function save_sys_resource(){

        $data = request('post.');

        $ug=model('users_group');
        $ug->get($data['users_group_id']);
        $ug->sys_resources()->save($data['sys_resources_id']);

        return $this->rediect('sys_resource/'.$data['users_group_id']);

    }


}

