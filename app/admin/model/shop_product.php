<?php

namespace app\admin\model;
use heephp\model;
use heephp\relation;
use heephp\sysExcption;

class shop_product extends model
{
    protected $autotimespan = true;
    protected $update_message_validata = "商品名称|必填;商品类别|不能为空;商品介绍|不能为空;一口价|不能为空+请输入正确的金额;封面图|必须输入";
    protected $update_validata = "name|must;shop_category_id|must;detail|must;price|must+double=2;pic|must";
    protected $softdel = true;

    public function __construct()
    {
        $this->key = 'shop_product_id';

        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;

    }


    public function pics(){
        $re = new relation($this,'shop_product_pic',$this->key,'shop_product_id','pics');
        return $re->hasmore();
    }

    public function category(){
        $re = new relation($this,'shop_category','shop_category_id','shop_category_id','category');
        return $re->belong();
    }

    public function create_user(){
        $re = new relation($this,'users','create_users_id','users_id');
        return $re->belong();
    }

    public function attrs(){
        $re = new relation($this,'shop_product_attr',$this->key,'shop_product_id','attrs');
        return $re->hasmore();
    }

    public function skus(){
        $re = new relation($this,'shop_product_sku',$this->key,'shop_product_id','skus');
        return $re->hasmore();
    }

    public function savedata($data){
        $dat = [];
        //商品数据保存
        $dat['shop_category_id']=$data['shop_category_id'];
        $dat['name']=$data['name'];
        $dat['price']=$data['price'];
        $dat['stock']=$data['stock'];
        $dat['remark']=$data['remark'];
        $dat['pic']=$data['pic_default'];
        $dat['detail']=$data['detail'];

        $pid = $this->save($dat);
        if(!$pid){
            return false;
        }


        //获取图片
        $pics = $data['pic'];
        $i=0;
        $mspp = model('shop_product_pic');
        foreach ($pics as $p){
            $pd['shop_product_id']=$pid;
            $pd['url']=$p;
            $pd['title']=$dat['name'];
            $pd['ord']=$i++;
            $result = $mspp->saveByWhere($pd,"shop_product_id=$pid and url='$p'");
        }
        //删除不需要的图片
        $urls = '\''.implode('\',\'',$pics).'\'';
        $mspp->deleteByWhere("shop_product_id=$pid and url not in ($urls)");

        //获取SKU 和 属性
        $skurecord=[];
        //属性字符串
        $attrlist ='';
        $mspa = model('shop_product_attr');
        foreach ($data as $key=>$val){
            //获取属性
            if(($key&'attr_')=='attr_'){

                $attrns = explode('_',$key);
                $attrname = $attrns[1];
                $attrlist .= "'$attrname',";

                $d['shop_product_id']=$pid;
                $d['shop_attr_name']=$attrname;
                $d['value']=$val;
                $result = $mspa->saveByWhere($d,"shop_product_id='$pid' and shop_attr_name='$attrname'");


            }elseif (($key&'sku_')=='sku_'){
                //获取SKU
                $skuns = explode('_',$key);
                $field = $skuns[1];
                $skuvlues = explode($field.'_',$key);
                $skus = str_replace('|_|',',',$skuvlues[1]);

                $skurecord[$skus][$field]=$val;

            }

        }

        //删除不需要的属性
        $attrlist=trim($attrlist,',');
        $mspa->deleteByWhere("shop_product_id=$pid and shop_attr_name not in($attrlist)");

        //保存SKU
        $msku=model('shop_product_sku');
        //SKu字符串列表
        $skulist = '';
        foreach ($skurecord as $k=>$v){
            if(!empty($v['markprice'])||!empty($v['price'])||!empty($v['stock'])) {
                $insertid = $msku->saveByWhere(['shop_product_id' => $pid, 'shop_sku_cls' => $k, 'markprice' => $v['markprice'] ?? 0, 'price' => $v['price'] ?? 0, 'stock' => $v['stock']] ?? 0, "shop_product_id=$pid and shop_sku_cls='$k'");
                $skulist .= '\'' . $v . '\',';
            }
        }
        $skulist = trim($skulist,',');
        //删除不需要的SKU
        $msku->deleteByWhere("shop_product_id=$pid".(!empty($skulist)?" and shop_sku_cls not in($skulist)":''));

        if($pid){
            return true;
        }

    }

}