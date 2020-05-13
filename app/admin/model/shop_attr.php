<?php

namespace app\admin\model;
use heephp\model;
use heephp\relation;

class shop_attr extends model
{
    protected $autotimespan = false;
    protected $update_message_validata = "名称|不能为空;|值|不能为空;";
    protected $update_validata = "name|must;values|must;";
    protected $softdel = false;

    public function __construct()
    {
        $this->key = 'shop_attr_id';

        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;

    }

    public function get_attrs(){
        return $this->page();
    }

    //将值转为数组
    public function get($id=''){
        $m = parent::get($id);
        $m['values']=explode(',',$m['values']);
        return $m;
    }

    //如果不存在则添加，存在则更新值
    public function savedata($name,$value){

        $m = $this->where("`name`='$name'")->find();
        if($m){
            $values = ','.$m['values'];
            if(strpos($values,','.$value.',')>-1){
                //如果存在则不添加
                return -1;
            }else{
                $values.=$value.',';
                $m['values']=str_replace(',,',',',$values);
                return $this->update($m);
            }
        }else{
            $m['name']=$name;
            $m['values']=$value.',';
            return $this->insert($m);
        }
    }

    public function del($name,$val){
        $m = $this->where("`name`='$name'")->find();
        if($m){
            $values = $m['values'];
            $m['values'] = str_replace($val.',','',$values);
            return $this->update($m);
        }
        return false;
    }

}