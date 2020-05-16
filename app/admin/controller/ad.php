<?php
namespace app\admin\controller;

use heephp\validata;

class ad extends adminBase
{
    function manager($field='create_time',$ord='desc')
    {

        $ad = model('ad');
        $ad->order("$field $ord")->page();
        $ad->create_user();
        $this->assign('list', $ad->data);
        $this->assign('pager', $ad->pager['show']);

        $this->assign('field',$field);
        $this->assign('order',$ord);
        return $this->fetch();
    }

    function add()
    {

        return $this->fetch('edit');
    }

    function edit($id)
    {

        $ad = model('ad');

        $ad->get($id);
        $this->assign('m', $ad->data);

        return $this->fetch();
    }

    function delete($id)
    {
        $ad = model('ad');
        $re = $ad->delete($id);
        if ($re) {
            return $this->success('删除成功！', url('manager'));
        } else
            return $this->error('删除失败');
    }

    function save()
    {
        $data = request('post.');
        $ad = model('ad');
        if (!empty($data['ad_id'])) {
            $result = $ad->update($data);
        } else {
            $result = $ad->insert($data);
        }
        if ($result) {
            return $this->success('保存成功！', url('manager'));
        } else
            return $this->error('保存失败！');
    }


}