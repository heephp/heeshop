<?php
namespace app\admin\controller;


use app\admin\model\sysmodel;

class model extends adminBase
{

    public function manager()
    {
        $sysmodel  = new sysmodel();
        $sysmodel ->page();
        $sysmodel->model_table();
        $sysmodel->create_user();
        $this->assign('list',$sysmodel->data);
        $this->assign('pager',$sysmodel->pager['show']);
        return $this->fetch();

    }


    public function add(){
        $mt = model('model_table');
        $mt->select();
        $this->assign('mt',$mt->data);

        return $this->fetch('edit');

    }

    public function edit($id){

        $mt = model('model_table');
        $mt->select();
        $this->assign('mt',$mt->data);

        $sysmodel  = new sysmodel();
        $m = $sysmodel->get($id);
        if(!$m){
            return $this->error('模型不存在！');
        }elseif ($m['is_sys']){
            return $this->error('系统模型无法编辑！');
        }
        $this->assign('m',$m);
        return $this->fetch();
    }

    public function save(){
        $data=request('post.');
        $sysmodel  = new sysmodel();

        if(!empty($data['model_id'])){

            $m = $sysmodel->get($data['model_id']);
            if(!$m){
                return $this->error('模型不存在！');
            }elseif ($m['is_sys']){
                return $this->error('系统模型无法删除！');
            }

            $result = $sysmodel->update($data);
        }else{
            $data['create_users_id']=request($this->session_id_str);
            $result = $sysmodel->insert($data);
        }
        if($result){
            cache()->clear();
            return $this->success('模型保存成功',url('manager'));
        }else{
            return $this->error('模型保存失败');
        }
    }

    public function del($id){
        $sysmodel  = new sysmodel();
        $m = $sysmodel->get($id);
        if(!$m){
            return $this->error('模型不存在！');
        }elseif ($m['is_sys']){
            return $this->error('系统模型无法删除！');
        }

        $isdel = $sysmodel->delete($id);
        if($isdel){
            return $this->success('删除成功！',url('manager'));
        }
        else{
            return $this->success('删除失败！');
        }
    }

}