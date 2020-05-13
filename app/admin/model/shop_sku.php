<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class shop_sku extends model
{
    protected $autotimespan = false;
    protected $update_message_validata = "分类|必填;值|不能为空;|显示文字|不能为空;";
    protected $update_validata = "cls|must;val|must;txt|must;";
    protected $softdel = false;

    public function __construct()
    {
        $this->key = 'shop_sku_id';

        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata = $this->update_message_validata;

    }

    public function skucls() : array{
        $data = $this->field('cls')->group('cls')->select();//db->getAll('select cls from '.$this->table_prefix.'shop_sku group by cls');
        return $data;
    }
}