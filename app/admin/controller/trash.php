<?php
namespace app\admin\controller;


class trash extends adminBase
{

    public function users(){
        $users=model('users');
        $list = $users->order('delete_time desc')->softdel()->page();
        $users->users_group();
        $this->assign('list',$users->data);
        $this->assign('pager',$users->pager['show']);
        return $this->fetch();
    }

    public function users_del($id){
        $users=model('users');
        $isdel = $users->softdel()->delete($id);
        if($isdel)
            return $this->success('用户删除成功！',url('users'));
        else
            return $this->error('用户删除失败！');
    }

    public function users_re($id){

        $users=model('users');
        $isre = $users->restore($id);

        if($isre){
            return $this->success('用户恢复成功',url('users'));
        }else{
            return $this->error('用户恢复失败',url('users'));
        }

    }

    public function users_group(){
        $ug=model('users_group');
        $list = $ug->order('delete_time desc')->softdel()->page();
        $ug->create_user();
        $this->assign('list',$ug->data);
        $this->assign('pager',$ug->pager['show']);

        return $this->fetch();
    }

    public function users_group_del($id){
        $ug=model('users_group');
        $isdel = $ug->softdel()->delete($id);
        if($isdel)
            return $this->success('用户组删除成功！',url('users_group'));
        else
            return $this->error('用户组删除失败！');
    }

    public function users_group_re($id){

        $ug=model('users_group');
        $isre = $ug->restore($id);

        if($isre){
            return $this->success('用户组恢复成功',url('users_group'));
        }else{
            return $this->error('用户组恢复失败',url('users_group'));
        }

    }


    public function menus(){
        $mun = model('menus');
        $mun->order('delete_time desc')->softdel()->page();
        $mun->child();
        $mun->create_user();
        $this->assign('list',$mun->data);
        $this->assign('pager',$mun->pager['show']);
        return $this->fetch();
    }

    public function menus_del($id){
        $menus=model('menus');
        $isdel = $menus->softdel()->delete($id);
        if($isdel)
            return $this->success('菜单删除成功！',url('menus'));
        else
            return $this->error('菜单删除失败！');
    }

    public function menus_re($id){

        $menus=model('menus');
        $isre = $menus->restore($id);

        if($isre){
            return $this->success('菜单恢复成功',url('menus'));
        }else{
            return $this->error('菜单恢复失败',url('menus'));
        }

    }

    public function message(){
        $mes = model('message');

        $mes->softdel()->page();
        $mes->sender();
        $mes->receiver();
        $this->assign('list',$mes->data);
        $this->assign('pager',$mes->pager['show']);
        return $this->fetch();
    }

    public function message_del($id){
        $message=model('message');
        $isdel = $message->softdel()->delete($id);
        if($isdel)
            return $this->success('用户删除成功！',url('message'));
        else
            return $this->error('用户删除失败！');
    }

    public function message_re($id){

        $mes = model('message');
        $isre = $mes->restore($id);

        if($isre){
            return $this->success('消息恢复成功',url('message'));
        }else{
            return $this->error('消息恢复失败',url('message'));
        }

    }


    public function comment(){
        $cmt = model('comment');
        $cmt->order('delete_time desc')->softdel()->page();
        $cmt->create_user();
        $this->assign('list',$cmt->data);
        $this->assign('pager',$cmt->pager['show']);
        return $this->fetch();
    }

    public function comment_del($id){
        $cmt=model('comment');
        $isdel = $cmt->softdel()->delete($id);
        if($isdel)
            return $this->success('评论删除成功！',url('menus'));
        else
            return $this->error('评论删除失败！');
    }

    public function comment_re($id){

        $isre = model('comment')->restore($id);

        if($isre){
            return $this->success('评论恢复成功',url('menus'));
        }else{
            return $this->error('评论恢复失败',url('menus'));
        }

    }


    public function ad(){
        $cmt = model('ad');
        $cmt->order('delete_time desc')->softdel()->page();
        $cmt->create_user();
        $this->assign('list',$cmt->data);
        $this->assign('pager',$cmt->pager['show']);
        return $this->fetch();
    }

    public function ad_del($id){
        $cmt=model('ad');
        $isdel = $cmt->softdel()->delete($id);
        if($isdel)
            return $this->success('广告删除成功！',url('menus'));
        else
            return $this->error('广告删除失败！');
    }

    public function ad_re($id){

        $isre = model('ad')->restore($id);

        if($isre){
            return $this->success('广告恢复成功',url('menus'));
        }else{
            return $this->error('广告恢复失败',url('menus'));
        }

    }

}