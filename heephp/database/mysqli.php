<?php

namespace heephp\database;
// 数据库连接类
use http\Exception;
use heephp\trace;
use heephp\logger;
use heephp\sysExcption;

class mysqli implements databaseInterface
{
    //私有的属性
    //private static $dbcon=false;
    private $host;
    private $port;
    private $user;
    private $pass;
    private $db;
    private $charset;
    private static $link;
    private $pagesize;
    private $table_prefix;

    //私有的构造方法
    public function __construct($host, $port, $user, $pass, $db, $charset = 'utf8', $pagesize = 20)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->charset = $charset;
        $this->pagesize = $pagesize;
        $this->table_prefix = config('db.table_prefix');

        aop('database_init', self::$link);
        //连接数据库
        if (!self::$link)
            $this->db_connect();

        aop('database_connected', self::$link);

    }

    //连接数据库
    private function db_connect()
    {
        self::$link = mysqli_connect($this->host . ':' . $this->port, $this->user, $this->pass);

        //echo $this->host.':'.$this->port.$this->user.$this->pass;
        if (!self::$link) {
            throw new sysExcption('数据库连接失败:host:' . $this->host . ':' . $this->port . '   username:' . $this->user . '   password:' . $this->pass);

        } else {
            //选择数据库
            $this->db_usedb();
            //设置字符集
            $this->db_charset();
        }

    }

    //设置字符集
    private function db_charset()
    {
        mysqli_query(self::$link, "set names {$this->charset}");
    }

    //选择数据库
    private function db_usedb()
    {
        mysqli_query(self::$link, "use {$this->db}");
    }

    //私有的克隆
    private function __clone()
    {
        die('clone is not allowed');
    }

    //获取表所有字段信息
    public function getFileds($table)
    {
        $sql = "show full columns from `$this->table_prefix$table`";
        $filedinfo = $this->getAll($sql);
        return $filedinfo;
    }

    //获取表主键
    public function getKeyFiled($table, &$fileds = [])
    {
        $fileds = $this->getFileds($table);
        foreach ($fileds as $f) {
            if ($f['Key'] == 'PRI') {
                return $f['Field'];
            }
        }
        return 'id';
    }

    /**
     * 执行sql语句的方法
     * @sql 查询语句
     * @isselect 是否是select语句 是则启用缓存查询
     */
    public function query($sql)
    {

        $res = mysqli_query(self::$link, $sql);

        //调试记录sql
        trace::record_sql($sql);
        logger::sql($sql);

        if (!$res) {
            throw new sysExcption("sql语句执行失败$sql" . mysqli_error(self::$link) . "错误编码" . mysqli_errno(self::$link));
        }
        return $res;
    }

    //获得最后一条记录id
    public function getInsertid()
    {
        return mysqli_insert_id(self::$link);
    }

    /**
     * 查询某个字段
     * @param
     * @return string or int
     */
    public function getOne($sql)
    {

        $result = $this->getRow($sql);

        return  $result[array_key_first($result)];
    }

    //获取一行记录,return array 一维数组
    public function getRow($sql, $type = "assoc")
    {

        $query = $this->query($sql);
        if (!in_array($type, array("assoc", 'array', "row"))) {
            throw new sysExcption("mysqli_query error");
        }
        $funcname = "mysqli_fetch_" . $type;
        $result = $funcname($query);

        return $result;
    }

    //获取一条记录,前置条件通过资源获取一条记录
    private function getFormSource($query, $type = "assoc")
    {

        if (!in_array($type, array("assoc", "array", "row"))) {
            throw new sysExcption('mysqli_query error');
        }
        $funcname = "mysqli_fetch_" . $type;
        return $funcname($query);
    }

    //获取多条数据，二维数组
    public function getAll($sql)
    {

        $query = $this->query($sql);
        $list = [];
        while ($r = $this->getFormSource($query)) {
            $list[] = $r;
        }

        return $list;
    }


    public function select($table, $where, $fields = '*', $order = '', $skip = 0, $limit = 0)
    {
        $condition = '';
        if(is_array($where)){
            $arr = $where;
            $relation = 'and';
            foreach ($arr as $k=>$v){
                $condition.=" `$k`='$v'  $relation ";
            }
            $condition = substr($condition,0,strlen($condition)-4);
        } else {
            $condition = $where;
        }

        if (!empty($order)) {
            $order = " order by " . $order;
        }

        $limitstr = ($skip == 0 && $limit == 0) ? '' : ("limit $skip,$limit");

        $sql = "select $fields from $this->table_prefix$table where $condition $order $limitstr";

        $query = $this->query($sql);
        $list = array();
        while ($r = $this->getFormSource($query)) {
            $list[] = $r;
        }

        return $list;
    }

    /**
     * 定义添加数据的方法
     * @param string $table 表名
     * @param string orarray $data [数据]
     * @return int 最新添加的id
     */
    public function insert($table, $data)
    {

        $sql = $this->bulid_insert_sql($table, $data);
        $this->query($sql);
        //返回上一次增加操做产生ID值
        return $this->getInsertid();
    }

    private function bulid_insert_sql($table, $data)
    {
        //获取表字段信息  并判断是否是自增
        $fields = $this->getFileds($table);
        $keyfield = '';
        $keyfield_auto = false;
        foreach ($fields as $f) {
            if ($f['Key'] == 'PRI') {
                $keyfield = $f['Field'];
                if ($f['Extra'] == 'auto_increment') {
                    $keyfield_auto = true;
                }
            }
        }

        //遍历数组，得到每一个字段和字段的值
        $key_str = '';
        $v_str = '';

        foreach ($data as $key => $v) {
            //如果主键自增 排除主键
            if ($keyfield_auto && $key == $keyfield) {
                continue;
            }
            //$key的值是每一个字段s一个字段所对应的值
            $key_str .= '`' . $key . '`,';
            $v_str .= "'$v',";
        }
        $key_str = trim($key_str, ',');
        $v_str = trim($v_str, ',');
        //判断数据是否为空
        $sql = "insert into $this->table_prefix$table ($key_str) values ($v_str)";
        return $sql;
    }

    /*
    * 删除多条数据方法
    * @param1 $table, $where 表名 条件
    * @return 受影响的行数
    */
    public function delete($table, $where)
    {
        $sql = $this->bulid_delete_sql($table, $where);
        $this->query($sql);
        //返回受影响的行数
        return mysqli_affected_rows(self::$link);
    }

    private function bulid_delete_sql($table, $where)
    {
        $condition = '';
        if(is_array($where)){
            $arr = $where;
            $relation = 'and';
            foreach ($arr as $k=>$v){
                $condition.=" `$k`='$v'  $relation ";
            }
            $condition = substr($condition,0,strlen($condition)-4);
        } else {
            $condition = $where;
        }

        $sql = "delete from $this->table_prefix$table where $condition";
        return $sql;
    }

    /**
     * [修改操作description]
     * @param [type] $table [表名]
     * @param [type] $data [数据]
     * @param [type] $where [条件]
     * @return [type]
     */
    public function update($table, $data, $where, $limit = 0)
    {
        $sql = $this->bulid_update_sql($table, $data, $where, $limit);
        $this->query($sql);
        //返回受影响的行数
        return mysqli_affected_rows(self::$link);
    }

    private function bulid_update_sql($table, $data, $where, $limit)
    {
        //遍历数组，得到每一个字段和字段的值
        $str = '';
        $keyfiled = $this->getKeyFiled($table);
        foreach ($data as $key => $v) {
            if ($key == $keyfiled) continue;
            $str .= "`$key`='$v',";
        }
        $str = rtrim($str, ',');

        $condition = '';
        if(is_array($where)){
            $arr = $where;
            $relation = 'and';
            foreach ($arr as $k=>$v){
                $condition.=" `$k`='$v'  $relation ";
            }
            $condition = substr($condition,0,strlen($condition)-4);
        } else {
            $condition = $where;
        }

        if (!empty($limit)) {
            $limit = " limit " . $limit;
        } else {
            $limit = '';
        }
        //修改SQL语句
        $sql = "update `$this->table_prefix$table` set $str where $condition $limit";
        return $sql;
    }

}
