<?php
namespace heephp;
use heephp\orm\orm;
use mysql_xdevapi\Exception;

class model extends orm {

    protected $autotimespan=false;
    protected $softdel=false;
    protected $field_createtime='create_time';
    protected $field_updatetime='update_time';
    protected $field_deletetime='delete_time';

    /*验证字段*/
    /*格式：字段|规则，字段|规则，字段|规则。。。*/
    protected $insert_validata="";
    protected $update_validata="";
    protected $insert_message_validata="";
    protected $update_message_validata="";


    //protected $db;
    protected $table_prefix;
    protected $table;
    protected $key='';
    protected $pager='';
    protected $data=[];

    public function __construct($tablname)
    {
        parent::__construct();

        //获取表前缀
        $this->table_prefix=config('db.table_prefix');
        //获取当前表名
        $tn = explode('\\',$tablname);
        $this->table=empty($this->table)?$tn[count($tn)-1]:$this->table;
        //获取主键字段
        $this->key=empty($this->key)?$this->db->getKeyFiled($this->table):$this->key;

        aop('model_init');
    }


    public function insert($data){
        if(!$this->validata($data,'insert')){
            validata::showerror();
            return false;
        }
        if($this->autotimespan)
            $data[$this->field_createtime]=time();

        $this->set_autofield($data);
        return $this->db->insert($this->table,$data);
    }

    public function delete($id='',$soft=true)
    {

        if (!empty($id))
            $where = '`' . $this->key . '` = \'' . $id . '\'';
        else if(!empty($this->where)) {
            $where = $this->where;
            $this->where = '';
        }else {
            $where='1=1';
        }

        if ($this->softdel) {
            if ($soft) {
                $data[$this->field_deletetime] = time();
                return $this->db->update($this->table, $data, $where);
            }
        }

        return $this->db->delete($this->table, $where);
    }


    public function update($data)
    {
        if (!$this->validata($data, 'update')) {
            validata::showerror();
            return false;
        }
        if (empty($this->where))
            $where = '`' . $this->key . '` = \'' . $data[$this->key] . '\'';
        else {
            $where = $this->where;
        }

        if ($this->autotimespan)
            $data[$this->field_updatetime] = time();

        $this->set_autofield($data);
        return $this->db->update($this->table, $data, $where);
    }

    public function select()
    {
        $re = $this->all();
        $this->get_autofield($re);

        $this->data = $re;
        $this->pager = null;
        return $re;

    }

    /** 分页获取数据
     * @return array 仅返回获取到的数据   分页使用$this->pager获取
     */
    public function page(){

        $where=$this->where;
        $order=$this->order;
        $fields=empty($this->fields)?' * ':$this->fields;
        $pname=$this->pageparm;

        if(empty($where))
            $where='1=1';
        else
            $where=$this->softdelwhere();

        $pagesize=config('pagesize')??20;
        $page=1;
        $parms=[];
        foreach (PARMS as $item) {
            if(($item&($pname.'_'))==($pname.'_')){
                $item = explode('_',$item);
                $page = $item[count($item)-1];
            }else
                $parms[]=$item;
        }

        $re=[];
        $count=$this->count('*','c')->value('c');
        $count = empty($count)?0:$count;
        $re['count'] = $count;
        $re['pagesize']=$pagesize;
        $re['page']=$page;
        $re['pagecount']=ceil($count / $pagesize);

        $this->where($where);
        $this->order($order);
        $this->field($fields);
        $this->limit(($page<=1)?"0,$pagesize":((($page-1)*$pagesize).','.$pagesize));
        $data=parent::select();
        $this->get_autofield($data);

        $re['show']=(new \heephp\bulider\pager())->bulider($page,$re['pagecount'],$parms,$pname);

        $this->pager = $re;
        $this->data = $data;
        return $data;

    }

    /**
     * 根据软删除获取sql 条件 where
     * @onlySoftDel true只查找已被软删除的  False只查找未被软删除的
     */
    public function softdelwhere(){
        $where=$this->where;
        $alias=$this->alias;

        if($this->softdel){
            $tbname = '`'.(empty($alias)?$this->table_prefix.$this->table:$alias).'`.';
            if($this->issoftdel){
                if(empty($where)){
                    $where=" $tbname".$this->field_deletetime.'>0 ';
                }else{
                    $where='('.$where.") and $tbname".$this->field_deletetime.'>0 ';
                }

            }else {

                if (empty($where)) {
                    $where = " ($tbname" . $this->field_deletetime . " IS NULL or $tbname" . $this->field_deletetime . " <=0 or $tbname" . $this->field_deletetime . '=\'\')';
                } else {
                    $where = '(' . $where . ") and ($tbname" . $this->field_deletetime . " IS NULL or $tbname" . $this->field_deletetime . " <=0 or $tbname" . $this->field_deletetime . '=\'\')';
                }

            }

        }

        return $where;

    }


    public function find(){
        $data = parent::find();
        $this->get_autofield($data);
        $this->data = $data;
        $this->pager=null;
        return $data;
    }

    public function get($id=''){
        $data=parent::get($id);
        $this->get_autofield($data);
        $this->data =$data;
        $this->pager=null;
        return $data;
    }

    /**
     * 恢复软删除的数据
     * @param int $id
     */
    public function restore($id=0){
        if(empty($this->where)&&empty($id)){
            throw new sysExcption('缺少恢复数据的条件');
            exit;
        }

        if(!empty($id)){
            $this->where="`$this->key`='$id'";
        }
        return parent::update([$this->field_deletetime=>0]);
    }

    /**
     * 根据某字段获取数据
     */
    private function getby($field)
    {

        $re = $this->all();

        $this->get_autofield($re);

        if (!is_array($re))
            return '';

        if (count($re) == 0)
            return null;

        else if (count($re) == 1)
            return $re[0][$field];

        else {

            $rearr = [];
            for ($i = 0; $i < count($re); $i++) {
                $rearr[] = $re[$i][$field];
            }

            return $rearr;
        }
    }

    public function __call($name, $arguments)
    {
        $argcount = count($arguments);
        if(strstr($name,'getBy')==$name){
            $field = substr($name,5);
            $re = [];
            if($argcount<1)
                $re = $this->getby($field);
            else
                $re = call_user_func_array([$this,'getby'],[$field]);

            return $re;
        }

        throw  new sysExcption('model\\'.$this->table.'\\'.$name.'方法未定义');

    }

    /*将数据结果的值  自动转换字段的值*/
    private function get_autofield(&$values){

        if(!is_array($values)||empty($values))
            return;

        for($i=0;$i<count($values);$i++){

            if(empty($values[$i]))
                continue;

            //遍历所有数据行
            $line=$values[$i];
            foreach ($line as $k=>$v) {
                $timeformat = config('db.timeformat');
                if(!empty($timeformat)&&($k==$this->field_createtime||$k==$this->field_deletetime||$k==$this->field_updatetime)){
                    if(empty($values[$i][$k]))
                        $values[$i][$k]='';
                    else
                        $values[$i][$k]=date($timeformat,$values[$i][$k]);
                }elseif (method_exists($this, 'get_' .$k)){
                    //自动数据处理
                    $mname = 'get_'.$k;
                    $values[$i][$k]=$this->$mname($values[$i][$k]);

                }
            }

        }
    }

    /*将数据结果的值  自动转换字段的值*/
    private function set_autofield(&$values){

        if(!is_array($values)||empty($values))
            return;

            foreach ($values as $k=>$v) {
                if($k==$this->field_createtime||$k==$this->field_deletetime||$k==$this->field_updatetime) {
                    $values[$k]=time();
                }elseif (method_exists($this, 'set_' .$k)){
                    $mname = 'set_'.$k;
                    $values[$k]=$this->$mname($values[$k]);
                }
            }

    }


    public function __get($name)
    {
        if($name=='pager')
            return $this->pager;
        if($name=='data')
            return $this->data;
        if($name=='key')
            return empty($this->key)?$this->db->getKeyFiled($this->table):$this->key;
        if($name=='table')
            return $this->table;

    }

    public function __set($name, $value)
    {
        if($name=='data'){
            $this->data=$value;
        }elseif ($name=='validate_rule'){
            $this->insert_validata=$value;
            $this->update_validata=$value;
        }elseif ($name=='validate_msg'){
            $this->insert_message_validata=$value;
            $this->update_message_validata=$value;
        }elseif ($name=='autotimespan'){
            $this->autotimespan = $value;
        }elseif ($name='softdel'){
            $this->softdel=$value;
        }
    }

    /*
     * 验证，成功返回true
     * $data数据
     * $action  insert|update
     * */
    public function validata($data,$action='insert'){
        $isvalidata = false;

        $this->insert_validata = trim($this->insert_validata,';');
        $this->update_validata = trim($this->update_validata,';');
        $this->insert_message_validata=trim($this->insert_message_validata,';');
        $this->update_message_validata=trim($this->update_message_validata,';');


        //错误消息的数组
        $msgs = array();
        //验证规则的数组
        $vs=array();

        if($action=='insert'){
            if(empty($this->insert_validata))
                return true;

            $vs = explode(';',$this->insert_validata);
            $msgs = explode(';',$this->insert_message_validata);

        }else if($action=='update'){
            if(empty($this->update_validata))
                return true;

            $vs = explode(';',$this->update_validata);
            $msgs = explode(';',$this->update_message_validata);

        }

        $num=0;
        foreach ($vs as $v){

            list($field,$rules)=explode('|',$v);
            if(empty($field)){
                throw new sysExcption('验证规则出错：'.var_export($v,true).'缺少字段');
            }
            if(empty($rules)){
                throw new sysExcption('验证规则出错：'.var_export($v,true).'缺少规则');
            }
            $rarr = explode('+',$rules);
            $num_rule = 0;
            foreach ($rarr as $r){
                list($rname,$rparm)=explode('=',$r);
                $rparms=explode(',',$rparm);

                $vali =new validata($data[$field]);
                if(!method_exists($vali,$rname)){
                    throw new sysExcption('验证规则：'.$rname.'不存在！');
                }
                //调用验证
                $reval=false;
                if($rname=='unique'){
                    $reval = $vali->$rname($data[$field], $this->table, $field,$this->key,$data[$this->key]??null);
                }
                else if($rname=='equal'||$rname=='notequal'){
                    $reval=$vali->$rname($data[$field]);
                }else if(count($rparms)<2&&empty($rparms[0])){
                    $reval=$vali->$rname();
                }else
                    $reval = call_user_func_array(array($vali,$rname),$rparms);

                if(!$reval){
                    $rinfo = explode('|',$msgs[$num]);
                    $currtmsg = explode('+',$rinfo[1]);
                    $v_error['message']=$rinfo[0].$currtmsg[$num_rule];
                    $v_error['field']=$field;
                    $v_error['title']=$rinfo[0];
                    $v_error['rulename']=$rname;
                    $v_error['errmsg']=$currtmsg[$num_rule];
                    validata::set_error($v_error);
                    return false;
                }
                $num_rule++;
            }
            $num++;
        }

        return true;
    }

    /**
     * 保存数据 如果有条件，则根据条件否则根据主键 如果有主键则更新，没有则新增
     * @param $data
     * @return bool|int|mixed
     */
    public function save($data){

        $where = $this->where;
        if(!empty($where)){

            $result = $this->select();
            if(empty($result)){
                return $this->insert($data);
            }else{
                $eff=$this->where($where)->update($data);
                if($eff)
                    return $data[$this->key];
                else
                    return false;
            }

        }else {
            if (empty($data[$this->key])) {
                return $this->insert($data);
            } else {
                return $this->update($data);
            }

        }
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->table;
    }
}