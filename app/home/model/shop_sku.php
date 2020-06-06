<?php
namespace app\home\model;
use heephp\model;
use heephp\relation;

class shop_sku extends model
{
    protected $autotimespan = false;
    protected $softdel = false;

    public function __construct()
    {
        $this->key = 'shop_sku_id';

        parent::__construct(__CLASS__);

    }

    public function skucls() : array{
        $data = $this->field('cls')->group('cls')->select();//db->getAll('select cls from '.$this->table_prefix.'shop_sku group by cls');
        return $data;
    }
}