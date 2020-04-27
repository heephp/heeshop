<?php
namespace app\admin\controller;

class link_group extends adminBase
{

    function manager()
    {
        $group=model('link_group');
        $group->page();
        $group->create_user();
        $this->assign('list',$group->data);
        $this->assign('pager',$group->pager['show']);

        return $this->fetch();
    }


    function add(){

        return $this->fetch('edit');
    }

    function edit($id){

        $group = model('link_group');

        $group->get($id);

        $this->assign('m',$group->data);
        return $this->fetch();
    }

    function delete($id){
        $group = model('link_group');
        $re = $group->delete($id);
        if($re){
            cache()->clear();
            return $this->success('删除成功！',url('manager'));
        }else
            return $this->error('删除失败');
    }

    function save(){
        $data=request('post.');
        $group = model('link_group');
        if(!empty($data[$group->key])){
            $result = $group->update($data);
        }else{
            $data['create_users_id']=request($this->session_id_str);
            $result = $group->insert($data);
        }
        if($result){
            cache()->clear();
            return $this->success('保存成功','manager');
        }else{
            return $this->error('保存失败');
        }
    }

}