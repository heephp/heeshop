<?php
namespace app\admin\controller;

use heephp\validata;

class guestbook extends adminBase
{
    function manager()
    {
        $gb = model('guestbook');
        $gb->page();
        $this->assign('list',$gb->data);
        $this->assign('pager',$gb->pager['show']);
        return $this->fetch();
    }

    function add(){
        return $this->fetch('edit');
    }

    function edit($id){
        $gb = model('guestbook');
        $gb->get($id);
        $this->assign('m',$gb->data);
        return $this->fetch();
    }

    function save(){
        $data = request('post.');
        $gb = model('guestbook');
        $reslut = $gb->save($data);
        if($reslut){
            return $this->success('保存成功！',url('manager'));
        }else{
            return $this->error('保存失败！');
        }
    }

    function delete($id){
        $gb = model('guestbook');
        $re = $gb->delete($id);
        if($re){
            return $this->success('删除成功！',url('manager'));
        }else{
            return $this->error('删除失败！');
        }
    }

}