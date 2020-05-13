<?php

namespace app\admin\controller;


class shop_pay extends adminBase
{
    public function manager($field='create_time',$order='asc'){

        $mp=model('shop_pay');
        $mp->order("$field $order")->page();

        $this->assign('list',$mp->data);
        $this->assign('pager',$mp->pager['show']);

        $this->assign('field',$field);
        $this->assign('order',$order);

        return $this->fetch();

    }

    public function clear_nopay()
    {
        $mp = model('shop_pay');
        $result = $mp->where("state=0")->delete();
        if ($result) {
            return $this->success('清空未支付流水成功！', url('manager'));
        } else {
            return $this->error('清空失败！');
        }
    }

}