<?php
namespace app\admin\controller;

use heephp\validata;

class comment extends adminBase
{
    function manager()
    {
        $comment = model('comment');
        $comment->page();
        $comment->create_user();
        $comment->category();
        $this->assign('list',$comment->data);
        $this->assign('pager',$comment->pager['show']);
        return $this->fetch();
    }

    function add(){
        return $this->fetch('edit');
    }

    function edit($id){
        $comment = model('comment');
        $comment->get($id);
        $this->assign('m',$comment->data);
        return $this->fetch();
    }

    function save(){
        $data = request('post.');
        $comment = model('comment');
        $reslut = $comment->save($data);
        if($reslut){
            return $this->success('保存成功！',url('manager'));
        }else{
            return $this->error('保存失败！');
        }
    }

    function delete($id){
        $comment = model('comment');
        $re = $comment->delete($id);
        if($re){
            return $this->success('删除成功！',url('manager'));
        }else{
            return $this->error('删除失败！');
        }
    }

}