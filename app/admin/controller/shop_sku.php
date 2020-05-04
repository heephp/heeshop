<?php
namespace app\admin\controller;

use heephp\validata;

class shop_sku extends adminBase
{

    function manager()
    {
        $msku = model('shop_sku');
        $msku->page('',$msku->key.' desc');
        $this->assign('list', $msku->data);
        $this->assign('pager', $msku->pager['show']);
        return $this->fetch();
    }

    function add()
    {
        $msku = model('shop_sku');
        $this->assign('skucls',$msku->skucls());

        return $this->fetch('edit');
    }

    function edit($id)
    {

        $msku = model('shop_sku');

        $msku->get($id);
        $this->assign('m', $msku->data);


        $msku = model('shop_sku');
        $this->assign('skucls',$msku->skucls());

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
        if (!empty($data[$msku->key])) {
            $result = $msku->update($data);
        } else {
            $result = $msku->insert($data);
        }
        if ($result) {
            return $this->success('SKU保存成功！', url('manager'));
        } else
            return $this->error('SKU保存失败！');
    }


}