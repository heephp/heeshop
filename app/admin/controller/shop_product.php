<?php
namespace app\admin\controller;

class shop_product extends adminBase
{
    function manager()
    {
        $product= model('shop_product');
        $product->page();
        $product->category();
        $product->create_user();
        $this->assign('list', $product->data);
        $this->assign('pager', $product->pager['show']);
        return $this->fetch();
    }

    function add()
    {
        $category = model('shop_category');
        $category->select('parent_id<0 or parent_id is NULL or parent_id=\'\'');
        $category->child();
        $this->assign('plist',$category->data);

        return $this->fetch('edit');
    }

    function edit($id)
    {

        $product = model('shop_product');

        $category = model('shop_category');
        $category->select('parent_id<0 or parent_id is NULL or parent_id=\'\'');
        $category->child();
        $this->assign('plist',$category->data);

        $product->get($id);
        $this->assign('m', $product->data);
        return $this->fetch();

    }

    function delete($id)
    {
        $product = model('shop_product');
        $re = $product->delete($id);
        if ($re) {
            return $this->success('删除成功！', url('manager'));
        } else
            return $this->error('删除失败');
    }

    function save()
    {
        $data = request('post.');//var_dump($data);exit;
        $product = model('shop_product');
        if (!empty($data[$product->key])) {
            $result = $product->update($data);
        } else {
            $data['create_user_id']=request($this->session_id_str);
            $result = $product->insert($data);
        }
        if ($result) {
            return $this->success('保存成功！', url('manager'));
        } else
            return $this->error('保存失败！');
    }


}
