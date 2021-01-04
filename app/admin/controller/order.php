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
        $so->create_user();

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
        $so=model('order');
        $so->get($id);
        $so->detail();
        $this->assign('m',$so->data);
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
