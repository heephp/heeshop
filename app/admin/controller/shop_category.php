<?php
namespace app\admin\controller;


class shop_category extends adminBase
{

    function manager()
    {
        $cate=model('shop_category');
        $cate->whereEmpty('parent_id')->page();
        $cate->child();
        $cate->create_user();
        $this->assign('list',$cate->data);
        $this->assign('pager',$cate->pager['show']);

        return $this->fetch();
    }


    function add(){
        $cate = model('shop_category');
        $cate->whereEmpty('parent_id')->select();
        $this->assign('plist',$cate->data);

        $msku = model('shop_sku');
        $skus = $msku->skucls();
        $this->assign('skus',$skus);

        return $this->fetch('edit');
    }

    function edit($id){

        $cate = model('shop_category');

        $cate->whereEmpty('parent_id')->select();
        $this->assign('plist',$cate->data);

        $cate->get($id);
        $cate->skus();
        $cate->attrs();

        //sku类别
        $msku = model('shop_sku');
        $skus = $msku->skucls();
        $this->assign('skus',$skus);

        //属性类别
        $mattr = model('shop_attr');
        $attrs = $mattr->select();
        $this->assign('attrs',$attrs);

        $this->assign('m',$cate->data);
        return $this->fetch();
    }

    function delete($id){

        $product  = model('shop_product');
        $count = $product->where('category_id='.$id)->count()->value();
        if($count>0)
        {
            return $this->error('该分类中有未被删除的商品，请删除后再删除分类！');
        }

        $cate = model('shop_category');
        $re = $cate->delete($id);
        if($re){
            cache()->clear();
            return $this->success('栏目删除成功！',url('manager'));
        }else
            return $this->error('栏目删除失败');
    }

    function save(){
        $data=request('post.');
        $skus = $data['skus'];
        $attrs = $data['attrs'];
        unset($data['skus']);
        unset($data['attrs']);
        $cate = model('shop_category');

        if(!empty($data[$cate->key])){
            $result = $cate->update($data);
        }else{
            $data['create_users_id']=request($this->session_id_str);
            $result = $cate->insert($data);
            $data[$cate->key]=$result;
        }

        //保存分类的sku
        $catesku = model('shop_category_sku');
        if(is_array($skus)&&count($skus)>0) {
            foreach ($skus as $sku) {
                $m = $catesku->where('shop_category_id=' . $data[$cate->key] . " and shop_sku_cls='$sku'")->select();
                if (empty($m)) {
                    $catesku->insert(['shop_category_id' => $data[$cate->key], 'shop_sku_cls' => $sku]);
                } else {
                    $catesku->update(['shop_category_sku_id' => $m['shop_category_sku_id'], 'shop_category_id' => $data[$cate->key], 'shop_sku_cls' => $sku]);
                }
            }
            $catesku->where('shop_category_id=' . $data[$cate->key] . ' and shop_sku_cls not in(\'' . implode('\',\'', $skus) . '\')')->delete();
        }else

            $catesku->where('shop_category_id=' . $data[$cate->key])->delete();

        //保存属性
        $cate->get($data[$cate->key]);
            $attrids = model('shop_attr')->where("`name` in ('".implode('\',\'',$attrs??[])."')")->getByshop_attr_id();
            $cate->attrs()->save($attrids??'');


        if($result){
            cache()->clear();
            return $this->success('保存成功',url('manager'));
        }else{
            return $this->error('保存失败');
        }
    }

}