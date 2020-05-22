<?php

namespace app\admin\controller;


class page extends adminBase
{
    public function manager($field='create_time',$order='asc'){

        $mp=model('pages');
        $mp->order("$field $order")->page();
        $mp->create_user();

        $this->assign('list',$mp->data);
        $this->assign('pager',$mp->pager['show']);

        $this->assign('field',$field);
        $this->assign('order',$order);

        return $this->fetch();

    }

    public function add(){

        return $this->fetch('edit');
    }

    public function edit($id){

        $mp=model('pages');
        $mp->get($id);
        $this->assign('m',$mp->data);
        return $this->fetch();
    }

    public function save(){
        $data= request('post.');
        $mp=model('pages');
        $data['create_users_id']=request($this->session_id_str);
        $id = $mp->save($data);
        if($id){
            return $this->success('保存成功！',url('manager'));
        }else{
            return $this->error('保存失败！');
        }
    }

    public function delete($id){
        $mp=model('pages');
        $eff = $mp->delete($id);
        if($eff){
            return $this->success('删除成功！',url('manager'));
        }else{
            return $this->error('删除失败');
        }
    }

}