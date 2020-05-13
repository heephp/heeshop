<?php
namespace app\admin\controller;

use heephp\validata;

class shop_sku extends adminBase
{
    public function __construct()
    {
        parent::__construct();

        $msku = model('shop_sku');
        $this->assign('skucls',$msku->skucls());

        $this->assign('cls',request('get.cls'));
    }

    function manager($cls='')
    {
        $cls = urldecode($cls);
        $this->assign('cls',$cls);

        $msku = model('shop_sku');
        $msku->where(empty($cls)?'1=1':"cls='$cls'")->order($msku->key.' desc')->page();
        $this->assign('list', $msku->data);
        $this->assign('pager', $msku->pager['show']);
        return $this->fetch();
    }

    function add()
    {


        return $this->fetch('edit');
    }

    function edit($id)
    {

        $msku = model('shop_sku');

        $msku->get($id);
        $this->assign('m', $msku->data);


        return $this->fetch();
    }

    function delete($id)
    {
        $msku = model('shop_sku');
        $m=$msku->get($id);

        if(model('shop_category_sku')->count("shop_category_cls='".$m['cls']."''")>0){
            return $this->error('有商品分类正在使用该SKU，请删除相关商品的关联后，再删除SKU');
        }

        if(model('shop_product_sku')->count("shop_sku_id='".$m[$msku->key]."''")>0){
            return $this->error('有商品正在使用该SKU，请删除相关商品后，再删除SKU');
        }

        $re=$msku->delete($id);

        if ($re) {
            return $this->success('SKU删除成功！', url('manager'));
        } else
            return $this->error('SKU删除失败');
    }

    function save()
    {
        $data = request('post.');
        $msku = model('shop_sku');
        $result = $msku->save($data);
        if ($result) {
            return $this->success('SKU保存成功！', url('manager'));
        } else
            return $this->error('SKU保存失败！');
    }


}