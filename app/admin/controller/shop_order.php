<?php
namespace app\admin\controller;


class shop_order extends adminBase
{
    public function index(){
        return $this->fetch();
    }

    public function manager($filed='create_time',$order='desc'){
        $so=model('shop_order');
        $so->order("$filed $order")->page();

        $this->assign('list',$so->data);
        $this->assign('pager',$so->pager['show']);

        $this->assign('order',$order);
        $this->assign('field',$filed);

        return $this->fetch();
    }

    public function add(){
        return $this->fetch();
    }

    public function edit($id){
        $od = model('shop_order_detail');
        $list = $od->where("shop_order_id='$id'")->select();

        if(empty($list)){
            return $this->error('订单详细列表为空！');
        }

        $this->assign('list',$od->data);
        $this->assign('order_id',$id);
        return $this->fetch();
    }

    public function save_insert()
    {
        $data = request('post.');
        $so = model('shop_order');

        $date = new \DateTime();
        $orderid = ($date->format('ymdHisu') . randChar(6, 'number'));
        $data['shop_order_id'] = $orderid;

        $so->insert($data);
        $m = $so->where("shop_order_id=$orderid")->find();//var_dump($m);

        if ($m) {
            return $this->success('保存成功！', url('manager'));
        } else {
            return $this->error('保存失败！');
        }
    }

    public function delete($id){
        $so=model('shop_order');
        $result = $so->where("shop_order_id=$id")->delete();
        if($result){
            return $this->success('删除成功！',url('manager'));
        }else{
            return $this->error('删除失败！');
        }
    }
}
