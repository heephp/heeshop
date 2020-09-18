<?php
namespace heephp\orm;
use heephp\config;
use heephp\sysExcption;
use heephp\trace;

class orm
{
    protected $fields = '';
    protected $table = '';
    protected $where = '';
    protected $order = '';
    protected $groupby = '';
    protected $having = '';
    protected $limit = '';
    protected $join = '';
    protected $alias = '';
    //private $model='';
    protected $sql = '';
    protected $issoftdel = false;
    protected $cache=false;
    protected $pageparm = 'page';
    protected $key='';
    protected $db;

    public function __construct()
    {
        $this->db=db();
    }

    public function from($table)
    {
        $this->table = $table;
        $this->key = $this->db->getKeyFiled($table);
        return $this;
    }

    public function alias($name)
    {
        $this->alias = $name;
        return $this;
    }

    public function field($fields)
    {
        if (is_array($fields))
            $this->fields = '`' . implode('`,`', $fields) . '`';
        else
            $this->fields = empty($fields) ? '*' : $fields;

        return $this;
    }

    public function where($where)
    {
        $this->where='';
        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        if (is_callable($where)) {
            $this->where .= " $relation (" . $where(new wherebuilder()) . ')';
        } else {
            if (is_array($where)) {
                $w = '';
                foreach ($where as $k => $v) {
                    $w .= "`$k`='$v' $relation ";
                }
                $w = substr($w, 0, strlen($w) - 4);
                $this->where .= $relation . '(' . $w . ')';
            } else {
                $this->where .= $relation . "($where)";
            }
        }
        return $this;
    }

    public function whereAnd($where)
    {
        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        if (is_callable($where)) {
            $this->where .= " $relation (" . $where(new wherebuilder()) . ')';
        } else {
            if (is_array($where)) {
                $w = '';
                foreach ($where as $k => $v) {
                    $w .= "`$k`='$v' $relation";
                }
                $w = substr($w, 0, strlen($w) - 4);
                $this->where .= $relation . '(' . $w . ')';
            } else {
                $this->where .= $relation . "($where)";
            }
        }
        return $this;
    }

    public function order($ord)
    {
        $this->order = $ord;
        return $this;
    }

    public function whereOr($where)
    {
        $relation = '';
        if (!empty($this->where))
            $relation = ' or ';

        if (is_callable($where)) {
            $this->where .= " $relation (" . $where(new wherebuilder()) . ')';
        } else {
            if (is_array($where)) {
                $w = '';
                foreach ($where as $k => $v) {
                    $w .= "`$k`='$v' $relation ";
                }
                $w = substr($w, 0, strlen($w) - 4);
                $this->where .= $relation . '(' . $w . ')';
            } else {
                $this->where .= $relation . "($where)";
            }
        }
        return $this;
    }

    public function whereIn($filed, $where)
    {
        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        if (is_callable($where)) {
            $this->where .= " $relation $filed in (" . $where(new wherebuilder()) . ')';
        } else {
            if (is_array($where)) {
                $this->where .= $relation . $filed . ' in (' . implode(',', $where) . ')';
            } else {
                $this->where .= $relation . $filed . " in ($where)";
            }
        }
        return $this;
    }

    public function whereNotIn($filed, $where)
    {
        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        if (is_callable($where)) {
            $this->where .= " $relation $filed not in (" . $where(new wherebuilder()) . ')';
        } else {
            if (is_array($where)) {
                $this->where .= $relation . $filed . ' not in(' . implode(',', $where) . ')';
            } else {
                $this->where .= $relation . $filed . " not in($where)";
            }
        }
        return $this;
    }

    public function whereBetween($filed, $v1, $v2)
    {

        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        $this->where .= $relation . " $filed between $v1 and $v2 ";

        return $this;
    }

    public function whereIsNULL($filed)
    {

        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        $this->where .= $relation . " $filed IS NULL ";

        return $this;
    }

    public function whereIsNotNULL($filed)
    {

        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        $this->where .= $relation . " $filed IS NOT NULL ";

        return $this;
    }

    public function whereEmpty($field){
        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        $this->where .= $relation . " `$field` IS NULL or `$field`='' or `$field`=0 ";

        return $this;
    }

    public function distinct($field)
    {
        $this->fields .= 'distinct ' . $field . ' ';
        return $this;
    }

    public function whereNotBetween($filed, $v1, $v2)
    {
        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        $this->where .= $relation . " $filed not between $v1 and $v2 ";

        return $this;
    }

    public function EXISTS($where)
    {
        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        if (is_callable($where)) {
            $this->where .= $relation . " EXISTS (" . $where(new orm()) . ')';
        } else {
            $this->where .= $relation . " EXISTS ($where)";
        }

        return $this;
    }

    public function NotEXISTS($where)
    {
        $relation = '';
        if (!empty($this->where))
            $relation = ' and ';

        if (is_callable($where)) {
            $this->where .= $relation . " NOT EXISTS (" . $where(new orm()) . ')';
        } else {
            $this->where .= $relation . " NOT EXISTS ($where)";
        }

        return $this;
    }

    public function group($field)
    {
        $this->groupby = $field;
        return $this;
    }

    public function having($field)
    {
        $this->having = $field;
        return $this;
    }

    public function sum($field, $alias = '')
    {
        if (!empty($this->fields))
            $this->fields .= ',';

        $this->fields .= "sum($field) $alias";
        return $this;
    }

    public function avg($field, $alias = '')
    {
        if (!empty($this->fields))
            $this->fields .= ',';

        $this->fields .= "avg($field) $alias";
        return $this;
    }

    public function count($field='*', $alias = '')
    {
        if (!empty($this->fields))
            $this->fields .= ',';

        $field=empty($field)?'*':$field;
        $this->fields .= "count($field) $alias";
        return $this;
    }

    public function max($field, $alias = '')
    {
        if (!empty($this->fields))
            $this->fields .= ',';

        $this->fields .= "max($field) $alias";
        return $this;
    }

    public function min($field, $alias = '')
    {
        if (!empty($this->fields))
            $this->fields .= ',';

        $this->fields .= "min($field) $alias";
        return $this;
    }

    public function limit($str)
    {
        $this->limit = $str;
        return $this;
    }

    public function softdel($issoft=true)
    {
        $this->issoftdel = $issoft;
        return $this;
    }

    public function cache($iscache=true){
        $this->cache=$iscache;
        return $this;
    }

    public function join($type, $join, $relation = '')
    {
        if (is_callable($join)) {
            $this->join .= $join(new orm());
        } else {
            $table = config('db.table_prefix') . $join;
            $this->join .= "$type join $table on $relation";
        }
        return $this;
    }

    public function all()
    {

        $data = $this->get_data_from_cache('getAll');
        return $data;
    }

    public function select(){
        return $this->all();
    }

    public function get($id = '')
    {
        if (!empty($id)) {
            $this->where =" `$this->key` = '$id'";
        }

        return $this->get_data_from_cache('getRow');

    }

    /**
     * 从缓存中获取数据
     * @param $sql
     * @param $datafun 回调函数
     * @return bool|array
     */
    private function get_data_from_cache($method)
    {
        $sql = $this->sql();
        //是否开启缓存
        if ($this->cache) {

            $cachename = md5($sql);
            $cvalue = cache($cachename);
            if (empty($cvalue)) {
                $data = $this->db->$method($sql);
                cache($cachename, $data);
                return $data;
            } else {
                return $cvalue;
            }

        } else {
            $data = $this->db->$method($sql);
            return $data;
        }
    }

    public function value($field='')
    {
        if(empty($field)) {

            return $this->get_data_from_cache('getOne');

        }else{
            $list = $this->all();
            if(count($list)==1){
                return $list[0][$field];
            }else{
                return array_column($list,$field);
            }
        }
    }

    public function find()
    {
        return $this->get_data_from_cache('getRow');
    }

    public function pageparm($val){
        $this->pageparm=empty($val)?'page':$val;
        //路由中注册pagetag
        \heephp\route::create()->reg_pagetag($this->pageparm);
        return $this;
    }

    public function table($tbname){
        $this->table=$tbname;
        $this->key = $this->db->getKeyFiled($tbname);
        return $this;
    }

    public function update($data){
        return $this->db->update($this->table,$data,$this->where);
    }

    public function insert($data){
        return $this->db->insert($this->table,$data);
    }

    public function save($data){

        $where = $this->where;
        if(!empty($where)){

            $result = $this->select();
            if(empty($result)){
                return self::insert($data);
            }else{
                $eff=self::where($where)->update($data);
                if($eff)
                    return $data[$this->key];
                else
                    return false;
            }

        }else {

            if (empty($data[$this->key])) {
                return self::insert($data);
            } else {
                return self::update($data);
            }

        }
    }

    public function delete($id=''){
        if(empty($id)){
            return $this->db->delete($this->table,$this->where);
        }else{
            return $this->db->delete($this->table,"`$this->key`='$id''");
        }
    }


    public function sql(){
        if(empty($this->table)){
            throw new sysExcption('ORM表名为空');
            exit;
        }
        $fileds = empty($this->fields)?'*':$this->fields;

        if(method_exists($this,'softdelwhere'))
            $softdelwhere = $this->softdelwhere();
        else
            $softdelwhere = $this->where;
        $where = empty($softdelwhere)?'':"where $softdelwhere";

        $order = empty($this->order)?'':"order by $this->order";
        $limit = empty($this->limit)?'':"limit $this->limit";
        $table = config('db.table_prefix').$this->table;
        $groupby = empty($this->groupby)?'':'group by '.$this->groupby;
        $having = empty($this->having)||empty($this->groupby)?'':'having '.$this->having;
        $this->sql="select $fileds from $table $this->alias $this->join $where $groupby $order $having $limit";

        return $this->sql;
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

        $pagesize=config('pagesize')??20;
        $page=1;
        $parms=[];
        foreach (PARMS as $item) {
            if(($item&($pname.'_'))==($pname.'_')){
                $item = explode('_',$item);
                $page = $item[1];
            }else
                $parms[]=$item;
        }

        $re=[];
        $count=$this->count('*','c')->value('c');
        $re['count'] = $count;
        $re['pagesize']=$pagesize;
        $re['page']=$page;
        $re['pagecount']=ceil($count / $pagesize);

        $this->where($where);
        $this->order($order);
        $this->field($fields);
        $this->limit(($page<=1)?"0,$pagesize":((($page-1)*$pagesize).','.$pagesize));
        $data=$this->select();

        $re['show']=(new \heephp\bulider\pager())->bulider($page,$re['pagecount'],$parms,$pname);

        $redata['pager'] = $re;
        $redata['data'] = $data;
        return $redata;

    }

}

