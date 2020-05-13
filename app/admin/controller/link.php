<?php
namespace app\admin\controller;

use heephp\validata;

class link extends adminBase
{
    public function __construct()
    {
        parent::__construct();

        if(!METHOD=='edit') {
            $lp = model('link_group');
            $lg = $lp->get(PARMS[0]);
            $this->assign('group', $lg);
        }
    }

    function manager($link_group_id)
    {
        $lp=model('link_group');
        $lg = $lp->get($link_group_id);
        $this->assign('group',$lg);

        $link = new \app\admin\model\link();
        $link->where("link_group_id=$link_group_id and (parent_id<1 or parent_id is NULL or parent_id='')")->page();
        $link->create_user();
        $link->child();
        $this->assign('list', $link->data);
        $this->assign('pager', $link->pager['show']);
        return $this->fetch();
    }

    function add($parent_id=0,$link_group_id=0)
    {
        $link = model('link');
        $link->where('link_group_id='.$link_group_id.' and (parent_id<1 or parent_id IS NULL or parent_id=\'\')')->select();
        $this->assign('plist',$link->data);

        $lp = model('link_group');
        $lg = $lp->get($link_group_id);
        $this->assign('group', $lg);

        $this->assign('pid',$parent_id);
        $this->assign('link_group_id',$link_group_id);
        return $this->fetch('edit');
    }

    function edit($id)
    {

        $link = model('link');

        $link->get($id);
        $this->assign('m', $link->data);

        $link->where('link_group_id='.$link->data['link_group_id'].' and (parent_id<1 or parent_id IS NULL or parent_id=\'\')')->select();
        $this->assign('plist',$link->data);

        $lp = model('link_group');
        $lg = $lp->get($link->data['link_group_id']);
        $this->assign('group', $lg);

        return $this->fetch();
    }

    function delete($id)
    {
        $link = model('link');
        $link_group_id=$link->where('link_id='.$id)->getBylink_group_id();
        $re = $link->delete($id);
        if ($re) {
            return $this->success('删除成功！', url('manager',$link_group_id));
        } else
            return $this->error('删除失败');
    }

    function save()
    {
        $data = request('post.');
        $link = model('link');
        if (!empty($data['link_id'])) {
            $result = $link->update($data);
        } else {
            $result = $link->insert($data);
        }
        if ($result) {
            return $this->success('保存成功！', url('manager/'.$data['link_group_id']));
        } else
            return $this->error('保存失败！');
    }


}