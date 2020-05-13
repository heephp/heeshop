<?php
namespace app\admin\controller;


class shop_cart extends adminBase
{
    public function index(){
        return $this->fetch();
    }

    public function manager(){
        $scart = model('shop_cart');
        $scart->group('create_users_id')->field('*')->sum('num','pcount')->sum('price','pricecount')->order('create_time desc')->page();
        $scart->product();
        $scart->create_user();
        //var_dump($scart->data);
        $this->assign('list',$scart->data);
        $this->assign('pager',$this->pager['show']);
        return $this->fetch();

    }

    public function edit($create_users_id){
        $scart = model('shop_cart');
        $scart->where('create_users_id='.$create_users_id)->page();
        $scart->product();
        $scart->create_user();
        $this->assign('list',$scart->data);
        $this->assign('pager',$scart->pager['show']);
        return $this->fetch();
    }


    public function delete($create_users_id){
        $scart = model('shop_cart');
        $eff = $scart->where('create_users_id='.$create_users_id)->delete();
        if($eff){
            return $this->success('删除成功',url('manager'));
        }else
            return $this->error('删除失败！');
    }

    public function delete_product($shop_cart_id){
        $scart = model('shop_cart');
        $eff = $scart->delete($shop_cart_id);
        if($eff){
            return $this->success('删除商品成功',url('manager'));
        }else
            return $this->error('删除商品失败！');
    }
}