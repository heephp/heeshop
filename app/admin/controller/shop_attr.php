<?php

namespace app\admin\controller;

use heephp\validata;

class shop_attr extends adminBase
{

    public function manager(){
        $mattr = model('shop_attr');
        $mattr->get_attrs();
        $this->assign('list',$mattr->data);
        $this->assign('pager',$mattr->pager['show']);

        return $this->fetch();
    }

    public function add(){
        $mattr = model('shop_attr');
        $attrs = $mattr->get_attrs();
        $this->assign('attrs',$attrs);

        return $this->fetch('edit');
    }

    public function edit($id){
        $mattr = model('shop_attr');
        $m = $mattr->get($id);
        $this->assign('m',$m);

        $attrs = $mattr->get_attrs();
        $this->assign('attrs',$attrs);

        return $this->fetch();
    }

    public function save()
    {
        $data = request('post.');
        $mattr = model('shop_attr');
        $m=$mattr->where("`name`='".$data['name']."'")->find();
        /*$result = 0;
        if (empty($data[$mattr->key])) {
            $result = $mattr->update($data);
        } else {
            $data['create_users_id'] = request($this->session_id_str);
            $result = $mattr->insert($data);
        }
        if ($result) {
            cache()->clear();
            return $this->success('保存成功', url('manager'));
        } else {
            return $this->error('保存失败');
        }*/
        $result = $mattr->savedata($data['name'],$data['value']);
        if($result==-1){
            return $this->error('已经存在的值！');
        }elseif($result>0){
            return $this->success('保存成功！',url('edit/'.$m['shop_attr_id']));
        }else{
            return $this->error('保存失败！');
        }
    }

    public function delete($name,$val){
        $name=urldecode($name);
        $val = urldecode($val);

        $mattr = model('shop_attr');
        $m = $mattr->where("`name`='$name'")->find();
        $result = $mattr->del($name,$val);
        if($result){
            return $this->success('删除成功！',url('edit',$m['shop_attr_id']));
        }else{
            return $this->error('删除失败！');
        }

    }


}