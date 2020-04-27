<?php
namespace app\admin\controller;


class trash extends adminBase
{

    public function users(){
        $users=model('users');
        $list = $users->page('1=1','delete_time desc','*',true);
        $users->users_group();
        $this->assign('list',$users->data);
        $this->assign('pager',$users->pager['show']);
        return $this->fetch();
    }

    public function users_del($id){
        $users=model('users');
        $isdel = $users->delete($id,false);
        if($isdel)
            return $this->success('用户删除成功！',url('users'));
        else
            return $this->error('用户删除失败！');
    }

    public function users_re($id){

        $db= db();
        $isre = $db->update('users',['delete_time'=>'0'],'users_id='.$id);

        if($isre){
            return $this->success('用户恢复成功',url('users'));
        }else{
            return $this->error('用户恢复失败',url('users'));
        }

    }

    public function users_group(){
        $ug=model('users_group');
        $list = $ug->page('1=1','delete_time desc','*',true);
        $ug->create_user();
        $this->assign('list',$ug->data);
        $this->assign('pager',$ug->pager['show']);

        return $this->fetch();
    }

    public function users_group_del($id){
        $ug=model('users_group');
        $isdel = $ug->delete($id,false);
        if($isdel)
            return $this->success('用户组删除成功！',url('users_group'));
        else
            return $this->error('用户组删除失败！');
    }

    public function users_group_re($id){

        $db= db();
        $isre = $db->update('users_group',['delete_time'=>'0'],'users_group_id='.$id);

        if($isre){
            return $this->success('用户组恢复成功',url('users_group'));
        }else{
            return $this->error('用户组恢复失败',url('users_group'));
        }

    }


    public function menus(){
        $mun = model('menus');
        $mun->page('1=1','delete_time desc','*',true);
        $mun->child();
        $mun->create_user();
        $this->assign('list',$mun->data);
        $this->assign('pager',$mun->pager['show']);
        return $this->fetch();
    }

    public function menus_del($id){
        $menus=model('menus');
        $isdel = $menus->delete($id,false);
        if($isdel)
            return $this->success('菜单删除成功！',url('menus'));
        else
            return $this->error('菜单删除失败！');
    }

    public function menus_re($id){

        $db= db();
        $isre = $db->update('menus',['delete_time'=>'0'],'menus_id='.$id);

        if($isre){
            return $this->success('菜单恢复成功',url('menus'));
        }else{
            return $this->error('菜单恢复失败',url('menus'));
        }

    }

    public function message(){
        $mes = model('message');

        $mes->page('1=1','delete_time desc','*','*',true);
        $mes->sender();
        $mes->receiver();
        $this->assign('list',$mes->data);
        $this->assign('pager',$mes->pager['show']);
        return $this->fetch();
    }

    public function message_del($id){
        $message=model('message');
        $isdel = $message->delete($id,false);
        if($isdel)
            return $this->success('用户删除成功！',url('message'));
        else
            return $this->error('用户删除失败！');
    }

    public function message_re($id){

        $db= db();
        $isre = $db->update('message',['delete_time'=>'0'],'message_id='.$id);

        if($isre){
            return $this->success('消息恢复成功',url('message'));
        }else{
            return $this->error('消息恢复失败',url('message'));
        }

    }

}