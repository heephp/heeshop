<?php
namespace app\admin\controller;

class category extends adminBase
{

    function manager()
    {
        $cate=model('category');
        $cate->page('parent_id<1 or parent_id IS NULL or parent_id=\'\'');
        $cate->child();
        $cate->create_user();
        $this->assign('list',$cate->data);
        $this->assign('pager',$cate->pager['show']);

        return $this->fetch();
    }


    function add(){
        $cate = model('category');
        $cate->select('parent_id<1 or parent_id IS NULL or parent_id=\'\'');
        $this->assign('plist',$cate->data);

        return $this->fetch('edit');
    }

    function edit($id){

        $cate = model('category');

        $cate->select('parent_id<1 or parent_id IS NULL or parent_id=\'\'');
        $this->assign('plist',$cate->data);

        $cate->get($id);

        $this->assign('m',$cate->data);
        return $this->fetch();
    }

    function delete($id){
        $cate = model('category');
        $re = $cate->delete($id);
        if($re){
            cache()->clear();
            return $this->success('删除成功！',url('manager'));
        }else
            return $this->error('删除失败');
    }

    function save(){
        $data=request('post.');
        $cate = model('category');
        if(!empty($data[$cate->key])){
            $result = $cate->update($data);
        }else{
            $data['create_users_id']=request($this->session_id_str);
            $result = $cate->insert($data);
        }
        if($result){
            cache()->clear();
            return $this->success('保存成功','manager');
        }else{
            return $this->error('保存失败');
        }
    }

}