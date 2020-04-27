<?php
namespace app\admin\controller;


class menus extends adminBase {

    function manager(){
        $mun = model('menus');
        $mun->page('parent_id<1 or parent_id IS NULL or parent_id=\'\'');
        $mun->child();
        $mun->create_user();
        $this->assign('list',$mun->data);
        $this->assign('pager',$mun->pager['show']);
        return $this->fetch();
    }

    function add(){
        $mun = model('menus');
        $mun->select('parent_id<1 or parent_id IS NULL or parent_id=\'\'');
        $this->assign('plist',$mun->data);

        return $this->fetch('edit');
    }

    function edit($id){

        $mun = model('menus');

        $mun->select('parent_id<1 or parent_id IS NULL or parent_id=\'\'');
        $this->assign('plist',$mun->data);

        $mun->get($id);
        //$mun->users();

        $this->assign('m',$mun->data);
        return $this->fetch();
    }

    function delete($id){
        $mun = model('menus');
        $re = $mun->delete($id);
        if($re){
            cache()->clear();
            return $this->success('删除成功！',url('manager'));
        }else
            return $this->error('删除失败');
    }

    function save(){
        $data=request('post.');
        $mun = model('menus');
        if(!empty($data['menus_id'])){
            $result = $mun->update($data);
        }else{
            $data['create_users_id']=request($this->session_id_str);
            $result = $mun->insert($data);
        }
        if($result){
            cache()->clear();
            return $this->success('保存成功','manager');
        }else{
            return $this->error('保存失败');
        }
    }
}

