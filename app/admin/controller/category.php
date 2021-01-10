<?php
namespace app\admin\controller;

use app\admin\model\sysmodel;

class category extends adminBase
{

    function manager()
    {
        $cate=model('category');
        $cate->whereEmpty('parent_id')->page();
        $cate->child();
        $cate->create_user();
        $this->assign('list',$cate->data);
        $this->assign('pager',$cate->pager['show']);

        return $this->fetch();
    }


    function add(){
        $cate = model('category');
        $cate->whereEmpty('parent_id')->select();
        $this->assign('plist',$cate->data);

        //$sysm =new sysmodel();
        //$sysm->select();
        //$this->assign('mlist',$sysm->data);

        return $this->fetch('edit');
    }

    function edit($id){

        $cate = model('category');

        $cate->whereEmpty('parent_id')->select();
        $this->assign('plist',$cate->data);

        //$sysm =new sysmodel();
        //$sysm->select();
        //$this->assign('mlist',$sysm->data);

        $cate->get($id);

        $this->assign('m',$cate->data);
        return $this->fetch();
    }

    function delete($id)
    {
        $cate = model('category');
        //判断是否有子栏目
        $ccount = $cate->where('parent_id='.$id)->count()->value();
        if ($ccount > 0) {
            return $this->error('栏目存在子栏目，删除子栏目后再删除该栏目！');
        }

        //判断是否是栏目模型表是否存在数据
        $_m = model('article');
        $mcount = $_m->where('category_id=' . $id)->count()->value();
        if ($mcount > 0) {
            return $this->error('栏目存在数据（包括回收站），清空后再删除！');
        }

        $re = $cate->delete($id);
        if ($re) {
            cache()->clear();
            return $this->success('栏目删除成功！', url('manager'));
        } else
            return $this->error('栏目删除失败');
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
            return $this->success('保存成功',url('manager'));
        }else{
            return $this->error('保存失败');
        }
    }

    /**
     * 信息管理
     * @return false|string
     */
    function managerinfo()
    {
        $cate=model('category');
        $cate->whereEmpty('parent_id')->select();
        $cate->child();
        $cate->create_user();
        $this->assign('list',$cate->data);
        $this->assign('pager',$cate->pager['show']);

        return $this->fetch();
    }



}