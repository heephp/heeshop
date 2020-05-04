<?php
namespace app\admin\controller;

use app\admin\model\sysmodel;

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

        $sysm =new sysmodel();
        $sysm->select();
        $this->assign('mlist',$sysm->data);

        return $this->fetch('edit');
    }

    function edit($id){

        $cate = model('category');

        $cate->select('parent_id<1 or parent_id IS NULL or parent_id=\'\'');
        $this->assign('plist',$cate->data);

        $sysm =new sysmodel();
        $sysm->select();
        $this->assign('mlist',$sysm->data);

        $cate->get($id);

        $this->assign('m',$cate->data);
        return $this->fetch();
    }

    function delete($id){
        $cate = model('category');
        $m = $cate->get($id);
        $model_id=$m['model_id'];

        //判断是否是栏目模型表是否存在数据
        $model = new sysmodel();
        $sysm = $model->get($model_id);
        if($sysm['is_sys']==1){
            //如果是系统模型 取表名并取数据量
            $_m =model($sysm['table_name']);
            $mcount = $_m->count('category_id='.$id);
            if($mcount>0){
                return $this->error('栏目存在数据（包括回收站），清空后再删除！');
            }
        }else{
            //如果是用户模型 取表名并取数据量
            $mt= model('model_table');
            $mtda = $mt->get($sysm['model_table_id']);
            if(!$mtda){
                return $this->error('用户模型表记录不存在！');
            }


            $_m =modeluser($mtda['name']);
            $mcount = $_m->count('category_id='.$id);
            if($mcount>0){
                return $this->error('栏目存在数据（包括回收站），清空后再删除！');
            }
        }

        $re = $cate->delete($id);
        if($re){
            cache()->clear();
            return $this->success('栏目删除成功！',url('manager'));
        }else
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
        $cate->page('parent_id<1 or parent_id IS NULL or parent_id=\'\'');
        $cate->child();
        $cate->create_user();
        $this->assign('list',$cate->data);
        $this->assign('pager',$cate->pager['show']);

        return $this->fetch();
    }

}