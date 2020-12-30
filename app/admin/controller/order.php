<?php
namespace app\admin\controller;


class order extends adminBase
{
    public function index(){
        return $this->fetch();
    }

    public function manager($filed='create_time',$order='desc'){
        $so=model('order');
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
        $od = model('order_detail');
        $list = $od->where("order_id='$id'")->select();

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
        $so = model('order');

        $date = new \DateTime();
        $orderid = ($date->format('ymdHisu') . randChar(6, 'number'));
        $data['order_id'] = $orderid;

        $so->insert($data);
        $m = $so->where("order_id=$orderid")->find();//var_dump($m);

        if ($m) {
            return $this->success('保存成功！', url('manager'));
        } else {
            return $this->error('保存失败！');
        }
    }

    public function delete($id){
        $so=model('order');
        $result = $so->where("order_id=$id")->delete();
        if($result){
            return $this->success('删除成功！',url('manager'));
        }else{
            return $this->error('删除失败！');
        }
    }
}
