<?php
namespace app\admin\model;
use heephp\model;
use heephp\relation;

class users extends model{

    protected $autotimespan=true;
    protected $update_message_validata="昵称|必填+字母数字下划线最少6位;email|不能为空+必须输入电子邮箱;";
    protected $update_validata="nickname|must+alphaNumDash=6;email|must+email;";
    protected $softdel=true;
    protected $key='users_id';

    public function __construct()
    {
        parent::__construct(__CLASS__);

        $this->insert_validata=$this->update_validata.'username|must+unique+alphaNumDash=6;';
        $this->insert_message_validata=$this->update_message_validata.'用户名|必填+已存在该用户名+字母数字下划线最少6位;';

    }

    public function users_group(){
        $relation = new relation($this,/*'belong',*/'users_group','users_group_id','users_group_id');
        return $relation->belong();
    }

    public function get_sex($val){
        return $val==1?'男':'女';
    }

    public function set_password($val){
        return md5($val);
    }

    public function set_sex($val){
        return $val=='男'?1:0;
    }

    public function set_birthday($val){
        if(empty($val))
            return time();
        return strtotime(date($val));
    }

    public function get_birthday($val){
        return date(config('db.dateformat'),$val);
    }

    public function get_header($val){
        return empty(trim($val))?'/assets/img/profile.jpg':trim($val);
    }

    public function get($id,$softdel=false)
    {
        $cachename = md5($id . '_' . $softdel);
        $this->data = cache($cachename);
        if (empty($this->data)) {
            $this->data = parent::get($id, $softdel);
            cache($cachename, $this->data);
            return $this->data;
        }
        return $this->data;
    }

        public function find($sql,$softdel=false)
        {
            $cachename = md5($sql . '_' . $softdel);
            $this->data = cache($cachename);
            if (empty($this->data)) {
                $this->data = parent::find($sql, $softdel);
                cache($cachename, $this->data);
                return $this->data;
            }
            return $this->data;
        }


}