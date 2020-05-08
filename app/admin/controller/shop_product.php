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

    function ajax_skus($category_id=0,$product_id=0){

        if(empty($category_id))
            return '';
        //获取商品分类的SKU
        $category = model('shop_category_sku');
        $cskulist = $category->select('shop_category_id='.$category_id);

        if(empty($cskulist))
            return '';

        $msku = model('shop_sku');
        $sql = '';
        $cls = [];
        foreach ($cskulist as $c){
            $i=$c['shop_category_sku_id'];
            $sql.="(select shop_sku_id id$i,cls cls$i,val val$i,txt txt$i from ".config('db.table_prefix')."shop_sku where cls='".$c['shop_sku_cls']."') as t".$i.' ,';
        }
        $sql = "select * from ".trim($sql,',');
        $result = ['cls'=>$cskulist,'list'=>db()->getAll($sql)];

        $this->assign('result',$result);

        //获取商品的SKU值
        $product = model('shop_product');
        $product->get($product_id);
        $product->skus();
        $this->assign('m',$product->data['skus']);

        return $this->fetch();
    }

    function ajax_attrs($category_id=0,$product_id=0){

        if(empty($category_id))
            return '';
        //获取分类属性
        $cate=model('shop_category');
        $cate->get($category_id);
        $cate->attrs();
        $this->assign('result',$cate->data['attrs']);
        //获取商品的属性值
        $product = model('shop_product');
        $product->get($product_id);
        $product->attrs();
        $this->assign('m',$product->data['attrs']);

        return $this->fetch();
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
        $result = $product->savedata($data);
        if(!$result){
            return $this->error('保存产品失败！');
        }else{
            return $this->success('保存产品成功！',url('manager'));
        }
    }


}
