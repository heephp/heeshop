<?php
namespace app\admin\controller;

use heephp\validata;

class ad extends adminBase
{
    function __construct()
    {
        parent::__construct();
        $ad = model('ad');
        $adgroup = $ad->field("`group` g")->group('g')->all();
        $this->assign('adgroup',$adgroup);
    }

    function manager($group='_',$field='create_time',$ord='desc')
    {

        $ad = model('ad');
        if(!empty($group)&&$group!='_')
            $ad=$ad->where("`group` ='$group'");
        $ad->order("`$field` $ord")->page();
        $ad->create_user();
        $this->assign('list', $ad->data);
        $this->assign('pager', $ad->pager['show']);

        $this->assign('field',$field);
        $this->assign('order',$ord);
        $this->assign('group',$group);
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
        $data['create_users_id']=request($this->session_id_str);
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