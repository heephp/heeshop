<?php
namespace app\admin\controller;


class sys_resources extends adminBase{

    function manager(){
        $res = model('sys_resources');
        $res->whereEmpty('parent_id')->page();
        $res->child();
        $res->create_user();
        $this->assign('list',$res->data);
        $this->assign('pager',$res->pager['show']);
        return $this->fetch();
    }

    function add(){

        $res = model('sys_resources');

        $plist = $res->whereEmpty("parent_id")-all();
        $this->assign('plist',$plist);

        return $this->fetch('edit');
    }

    function edit($id){

        $res = model('sys_resources');

        $plist = $res->whereEmpty("parent_id")-all();
        $this->assign('plist',$plist);

        $m=$res->get($id);
        $this->assign('m',$res->data);
        return $this->fetch();
    }

    function delete($id){
        $res = model('sys_resources');
        $re = $res->delete($id);
        if($re){
            return $this->success('删除成功！',url('manager'));
        }else
            return $this->error('删除失败');
    }

    function save(){
        $data=request('post.');
        $res = model('sys_resources');
        if(!empty($data[$res->key])){
            $result = $res->update($data);
        }else{
            $data['users_id']=request($this->session_id_str);
            $result = $res->insert($data);
        }
        if($result){
            return $this->success('操作成功！',url('manager'));
        }else
            return $this->error('操作失败！');
    }



}

