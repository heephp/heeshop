<?php

namespace app\admin\model;
use heephp\model;

class guestbook extends model
{
    protected $autotimespan = true;
    protected $softdel=false;

    protected $update_message_validata = "昵称|必填;留言内容|必填;";
    protected $update_validata = "nickname|must;context|must;";
    protected $key = 'guestbook_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata = $this->update_validata;
        $this->insert_message_validata=$this->update_message_validata;

    }
}