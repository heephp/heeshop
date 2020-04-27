<?php
namespace heephp\database;

use heephp\sysExcption;

/**
 * Class pdo
 *
 * // mysql connect
　　$db = new SQL('mysql:host=localhost;database=heephp_blog;', 'heephp.com_user', 'heephp.com_password');

　　// PDO SQLite3 connect
　　$db = new SQL('pdo:database=/heephp.com/heephp.sqlite3;');

　　// SQLite2 connect
　　$db = new SQL('sqlite:database=/heephp.com/heephp.sqlite;');
 *
 * @package heephp\database
 */
class pdo implements databaseInterface {

    private $adapter = "";

    private $method = "";

    private $version = "";

    private $conn = "";

    private $options = "";

    private $errorMessage = "";

    private $db = "";

    private $table_prefix='';

    public function __construct($connString, $user = "", $pass = "") {
        $this->table_prefix = config('db.table_prefix');
        list($this->adapter, $options) = explode(":", $connString, 2);

        if ($this->adapter != "sqlite") {

            $this->adapter = "mysql";

        }

        $optionsList = explode(";", $options);

        foreach ($optionsList as $option) {

            list($a, $b) = explode("=", $option);

            $opt[$a] = $b;

        }

        $this->options = $opt;

        $database = (array_key_exists("database", $opt)) ? $opt['database'] : "";

        if ($this->adapter == "sqlite" && substr(sqlite_libversion(), 0, 1) == "3" && class_exists("PDO") && in_array("sqlite", PDO::getAvailableDrivers())) {

            $this->method = "pdo";

            try

            {

                $this->conn = new PDO("sqlite:" . $database, null, null, array(PDO::ATTR_PERSISTENT => true));

            }

            catch (PDOException $error) {

                $this->conn = false;

                $this->errorMessage = $error->getMessage();
                throw new \heephp\sysExcption($this->method.'：'.$this->errorMessage);
            }

        } else if ($this->adapter == "sqlite" && substr(sqlite_libversion(), 0, 1) == "2" && class_exists("PDO") && in_array("sqlite2", PDO::getAvailableDrivers())) {

            $this->method = "pdo";

            try

            {

                $this->conn = new PDO("sqlite2:" . $database, null, null, array(PDO::ATTR_PERSISTENT => true));

            }

            catch (PDOException $error) {

                $this->conn = false;

                $this->errorMessage = $error->getMessage();
                throw new \heephp\sysExcption($this->method.'：'.$this->errorMessage);
            }

        } else if ($this->adapter == "sqlite") {

            $this->method = "sqlite";

            $this->conn = sqlite_open($database, 0666, $sqliteError);

        } else {

            $this->method = "mysql";

            $host = (array_key_exists("host", $opt)) ? $opt['host'] : "";

            $this->conn = mysqli_connect($host, $user, $pass,$database);

        }

        if ($this->conn && $this->method == "pdo") {

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

        }

        if ($this->conn && $this->adapter == "mysql") {

            $this->query("SET NAMES 'utf8'");

        }

        if ($this->conn && $database) {

            $this->db = $database;

        }

    }

    public function update($table, $data, $where, $limit = 0)
    {
        $str='';
        $keyfiled=$this->getKeyFiled($table);
        foreach($data as $key=>$v){
            if($key==$keyfiled) continue;
            $str.="`$key`='$v',";
        }
        $str=rtrim($str,',');
        if(is_array($where)){
            foreach ($where as $key => $val) {
                if(is_array($val)){
                    $condition = '`'.$key.'` in ('.implode(',', $val) .')';
                } else {
                    $condition = '`'.$key. '`=' .$val;
                }
            }
        } else {
            $condition = $where;
        }

        if (!empty($limit)) {
            $limit = " limit ".$limit;
        }else{
            $limit='';
        }
        //修改SQL语句
        $sql="update `$this->table_prefix$table` set $str where $condition $limit";
        $result = $this->query($sql);
        return $this->affectedRows($result);
        // TODO: Implement update() method.
    }
    public function select($table, $where, $fields = '*', $order = '', $skip = 0, $limit = 0)
    {

        if(is_array($where)){
            foreach ($where as $key => $val) {
                if (is_numeric($val)) {
                    $condition = $key.'='.$val;
                }else{
                    $condition = $key.'=\"'.$val.'\"';
                }
            }
        } else {
            $condition = $where;
        }
        if (!empty($order)) {
            $order = " order by ".$order;
        }

        $limitstr = ($skip==0&&$limit==0)?'':("limit $skip,$limit");

        $sql = "select $fields from $this->table_prefix$table where $condition $order $limitstr";

        $result=$this->query($sql);
        $list = $this->fetch($result);

        return $list;
        // TODO: Implement select() method.
    }
    public function insert($table, $data)
    {//获取表字段信息  并判断是否是自增
        $fields = $this->getFileds($table);
        $keyfield = '';
        $keyfield_auto=false;
        foreach ($fields as $f){
            if($f['Key']=='PRI'){
                $keyfield=$f['Field'];
                if($f['Extra']=='auto_increment'){
                    $keyfield_auto=true;
                }
            }
        }

        //遍历数组，得到每一个字段和字段的值
        $key_str='';
        $v_str='';

        foreach($data as $key=>$v){
            //如果主键自增 排除主键
            if($keyfield_auto&&$key==$keyfield){
                continue;
            }
            //$key的值是每一个字段s一个字段所对应的值
            $key_str.=$key.',';
            $v_str.="'$v',";
        }
        $key_str=trim($key_str,',');
        $v_str=trim($v_str,',');
        //判断数据是否为空
        $sql="insert into $this->table_prefix$table ($key_str) values ($v_str)";
        $result=$this->query($sql);
        return $this->affectedRows($result);
        // TODO: Implement insert() method.
    }
    public function getOne($sql)
    {
        $result  = $this->query($sql);
        $list =$this->result($result,0);

        return $list;
        // TODO: Implement getOne() method.
    }
    public function getRow($sql, $type = "assoc")
    {

        $result  = $this->query($sql);
        $list =$this->fetchAssoc($result);

        return $list;
        // TODO: Implement getRow() method.
    }
    public function getKeyFiled($table)
    {
        $fileds = $this->getFileds($table);
        foreach ($fileds as $f){
            if($f['Key']=='PRI'){
                return $f['Field'];
            }
        }
        return '';
        // TODO: Implement getKeyFiled() method.
    }
    public function getInsertid()
    {
        return $this->insertId();
        // TODO: Implement getInsertid() method.
    }
    public function getFileds($table)
    {
        if($this->method=='mysql'){
            $result = $this->describeTable($this->table_prefix.$table);
            $fildes = $this->fetch($result);
            return $fildes;
        }else
            return $this->describeTable($this->table_prefix.$table);
        // TODO: Implement getFileds() method.
    }
    public function getAll($sql)
    {

        $result = $this->query($sql);
        $list = $this->fetchAssoc($result);

        return $list;
        // TODO: Implement getAll() method.
    }
    public function delete($table, $where)
    {
        if (is_array($where)) {
            foreach ($where as $key => $val) {
                if (is_array($val)) {
                    $condition = $key . ' in (' . implode(',', $val) . ')';
                } else {
                    $condition = $key . '=' . $val;
                }
            }
        } else {
            $condition = $where;
        }
        $sql = "delete from $this->table_prefix$table where $condition";
        $result = $this->query($sql);
        $this->affectedRows($result);
        // TODO: Implement delete() method.
    }


    private function isConnected() {

        return ($this->conn !== false);

    }

    private function close() {

        return $this->disconnect();

    }

    private function disconnect() {

        if ($this->conn) {

            if ($this->method == "pdo") {

                $this->conn = null;

            } else if ($this->method == "mysql") {

                mysql_close($this->conn);

                $this->conn = null;

            } else if ($this->method == "sqlite") {

                sqlite_close($this->conn);

                $this->conn = null;

            }

        }

    }

    private function getAdapter() {

        return $this->adapter;

    }

    private function getMethod() {

        return $this->method;

    }

    private function getOptionValue($optKey) {

        if (array_key_exists($optKey, $this->options)) {

            return $this->options[$optKey];

        } else {

            return false;

        }

    }

    private function selectDB($db) {

        if ($this->conn) {

            if ($this->method == "mysql") {

                $this->db = $db;

                return (mysqli_select_db($this->conn,$db));

            } else {

                return true;

            }

        } else {

            return false;

        }

    }

    private function query($queryText) {

        if ($this->conn) {

            if ($this->method == "pdo") {

                $queryResult = $this->conn->prepare($queryText);

                if ($queryResult)

                    $queryResult->execute();

                if (!$queryResult) {

                    $errorInfo = $this->conn->errorInfo();

                    $this->errorMessage = $errorInfo[2];
                    throw new \heephp\sysExcption($this->method.'：'.$this->errorMessage);
                }

                return $queryResult;

            } else if ($this->method == "mysql") {

                $queryResult = mysqli_query($this->conn,$queryText );

                if (!$queryResult) {

                    $this->errorMessage = mysqli_error($this->conn);
                    throw new \heephp\sysExcption($this->method.'：'.$this->errorMessage);
                }

                return $queryResult;

            } else if ($this->method == "sqlite") {

                $queryResult = sqlite_query($this->conn, $queryText);

                if (!$queryResult) {

                    $this->errorMessage = sqlite_error_string(sqlite_last_error($this->conn));

                    throw new \heephp\sysExcption($this->method.'：'.$this->errorMessage);
                }

                return $queryResult;

            }

        } else {

            return false;

        }

    }

// Be careful using this function - when used with pdo, the pointer is moved

// to the end of the result set and the query needs to be rerun. Unless you

// actually need a count of the rows, use the isResultSet() function instead

    private function rowCount($resultSet) {

        if (!$resultSet)

            return false;

        if ($this->conn) {

            if ($this->method == "pdo") {

                return count($resultSet->fetchAll());

            } else if ($this->method == "mysql") {

                return mysqli_num_rows($resultSet);

            } else if ($this->method == "sqlite") {

                return sqlite_num_rows($resultSet);

            }

        }

    }

    private function num_rows($res) {

        return $this->rowCount($res);

    }

    private function isResultSet($resultSet) {

        if ($this->conn) {

            if ($this->method == "pdo") {

                return ($resultSet == true);

            } else {

                return ($this->rowCount($resultSet) > 0);

            }

        }

    }

    private function fetch($res) {

        while ($r= $this->fetchAssoc($res)) {
            $list[] = $r;
        }
        return $list;

    }

    private function fetchArray($resultSet) {

        if (!$resultSet)

            return false;

        if ($this->conn) {

            if ($this->method == "pdo") {

                return $resultSet->fetch(PDO::FETCH_NUM);

            } else if ($this->method == "mysql") {

                return mysqli_fetch_row($resultSet);

            } else if ($this->method == "sqlite") {

                return sqlite_fetch_array($resultSet, SQLITE_NUM);

            }

        }

    }

    private function fetchAssoc($resultSet) {

        if (!$resultSet)

            return false;

        if ($this->conn) {

            if ($this->method == "pdo") {

                return $resultSet->fetch(PDO::FETCH_ASSOC);

            } else if ($this->method == "mysql") {

                if(!$resultSet)
                    return false;

                return mysqli_fetch_assoc($resultSet);

            } else if ($this->method == "sqlite") {

                return sqlite_fetch_array($resultSet, SQLITE_ASSOC);

            }

        }

    }

    private function affectedRows($resultSet) {

        if (!$resultSet)

            return false;

        if ($this->conn) {

            if ($this->method == "pdo") {

                return $resultSet->rowCount();

            } else if ($this->method == "mysql") {

                return mysqli_affected_rows($this->conn);

            } else if ($this->method == "sqlite") {

                return sqlite_changes($resultSet);

            }

        }

    }

    private function result($resultSet, $targetRow, $targetColumn = "") {

        if (!$resultSet)

            return false;

        if ($this->conn) {

            if ($this->method == "pdo") {

                if ($targetColumn) {

                    $resultRow = $resultSet->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_ABS, $targetRow);

                    return $resultRow[$targetColumn];

                } else {

                    $resultRow = $resultSet->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_ABS, $targetRow);

                    return $resultRow[0];

                }

            } else if ($this->method == "mysql") {

                return mysqli_free_result($resultSet);

            } else if ($this->method == "sqlite") {

                return sqlite_column($resultSet, $targetColumn);

            }

        }

    }

    private function listDatabases() {

        if ($this->conn) {

            if ($this->adapter == "mysql") {

                return $this->query("SHOW DATABASES");

            } else if ($this->adapter == "sqlite") {

                return $this->db;

            }

        }

    }

    private function listTables() {

        if ($this->conn) {

            if ($this->adapter == "mysql") {

                return $this->query("SHOW TABLES");

            } else if ($this->adapter == "sqlite") {

                return $this->query("SELECT name FROM sqlite_master WHERE type = 'table' ORDER BY name");

            }

        }

    }

    private function hasCharsetSupport()

    {

        if ($this->conn) {

            if ($this->adapter == "mysql" && version_compare($this->getVersion(), "4.1", ">")) {

                return true;

            } else {

                return false;

            }

        }

    }

    private function listCharset() {

        if ($this->conn) {

            if ($this->adapter == "mysql") {

                return $this->query("SHOW CHARACTER SET");

            } else if ($this->adapter == "sqlite") {

                return "";

            }

        }

    }

    private function listCollation() {

        if ($this->conn) {

            if ($this->adapter == "mysql") {

                return $this->query("SHOW COLLATION");

            } else if ($this->adapter == "sqlite") {

                return "";

            }

        }

    }

    private function insertId() {

        if ($this->conn) {

            if ($this->method == "pdo") {

                return $this->conn->lastInsertId();

            } else if ($this->method == "mysql") {

                return mysqli_insert_id($this->conn);

            } else if ($this->method == "sqlite") {

                return sqlite_last_insert_rowid($this-conn);

            }

        }

    }

    private function escapeString($toEscape) {

        if ($this->conn) {

            if ($this->method == "pdo") {

                $toEscape = $this->conn->quote($toEscape);

                $toEscape = substr($toEscape, 1, -1);

                return $toEscape;

            } else if ($this->adapter == "mysql") {

                return mysqli_real_escape_string($toEscape);

            } else if ($this->adapter == "sqlite") {

                return sqlite_escape_string($toEscape);

            }

        }

    }

    private function getVersion() {

        if ($this->conn) {

// cache

            if ($this->version) {

                return $this->version;

            }

            if ($this->adapter == "mysql") {

                $verSql = mysqli_get_server_info($this->conn);

                $version = explode("-", $verSql);

                $this->version = $version[0];

                return $this->version;

            } else if ($this->adapter == "sqlite") {

                $this->version = sqlite_libversion();

                return $this->version;

            }

        }

    }

// returns the number of rows in a table

    private function tableRowCount($table) {

        if ($this->conn) {

            if ($this->adapter == "mysql") {

                $countSql = $this->query("SELECT COUNT(*) AS `RowCount` FROM `" . $table . "`");

                $count = (int)($this->result($countSql, 0, "RowCount"));

                return $count;

            } else if ($this->adapter == "sqlite") {

                $countSql = $this->query("SELECT COUNT(*) AS 'RowCount' FROM '" . $table . "'");

                $count = (int)($this->result($countSql, 0, "RowCount"));

                return $count;

            }

        }

    }

// gets column info for a table

    private function describeTable($table) {

        if ($this->conn) {

            if ($this->adapter == "mysql") {

                return $this->query("DESCRIBE `" . $table . "`");

            } else if ($this->adapter == "sqlite") {

                $columnSql = $this->query("SELECT sql FROM sqlite_master where tbl_name = '" . $table . "'");

                $columnInfo = $this->result($columnSql, 0, "sql");

                $columnStart = strpos($columnInfo, '(');

                $columns = substr($columnInfo, $columnStart+1, -1);

                $columns = preg_split(',[^0-9]', $columns);//split(',[^0-9]', $columns);

                $columnList = array();

                foreach ($columns as $column) {

                    $column = trim($column);

                    $columnSplit = explode(" ", $column, 2);

                    $columnName = $columnSplit[0];

                    $columnType = (sizeof($columnSplit) > 1) ? $columnSplit[1] : "";

                    $columnList[] = array($columnName, $columnType);

                }

                return $columnList;

            }

        }

    }



    private function getMetadata() {

        $output = '';

        if ($this->conn) {

            if ($this->adapter == "mysql" && version_compare($this->getVersion(), "5.0.0", ">=")) {

                $this->selectDB("information_schema");

                $schemaSql = $this->query("SELECT `SCHEMA_NAME` FROM `SCHEMATA` ORDER BY `SCHEMA_NAME`");

                if ($this->rowCount($schemaSql)) {

                    while ($schema = $this->fetchAssoc($schemaSql)) {

                        $output .= '{"name": "' . $schema['SCHEMA_NAME'] . '"';

// other interesting columns: TABLE_TYPE, ENGINE, TABLE_COLUMN and many more

                        $tableSql = $this->query("SELECT `TABLE_NAME`, `TABLE_ROWS` FROM `TABLES` WHERE `TABLE_SCHEMA`='" . $schema['SCHEMA_NAME'] . "' ORDER BY `TABLE_NAME`");

                        if ($this->rowCount($tableSql)) {

                            $output .= ',"items": [';

                            while ($table = $this->fetchAssoc($tableSql)) {

                                if ($schema['SCHEMA_NAME'] == "information_schema") {

                                    $countSql = $this->query("SELECT COUNT(*) AS `RowCount` FROM `" . $table['TABLE_NAME'] . "`");

                                    $rowCount = (int)($this->result($countSql, 0, "RowCount"));

                                } else {

                                    $rowCount = (int)($table['TABLE_ROWS']);

                                }

                                $output .= '{"name":"' . $table['TABLE_NAME'] . '","rowcount":' . $rowCount . '},';

                            }

                            if (substr($output, -1) == ",")

                                $output = substr($output, 0, -1);

                            $output .= ']';

                        }

                        $output .= '},';

                    }

                    $output = substr($output, 0, -1);

                }

            } else if ($this->adapter == "mysql") {

                $schemaSql = $this->listDatabases();

                if ($this->rowCount($schemaSql)) {

                    while ($schema = $this->fetchArray($schemaSql)) {

                        $output .= '{"name": "' . $schema[0] . '"';

                        $this->selectDB($schema[0]);

                        $tableSql = $this->listTables();

                        if ($this->rowCount($tableSql)) {

                            $output .= ',"items": [';

                            while ($table = $this->fetchArray($tableSql)) {

                                $countSql = $this->query("SELECT COUNT(*) AS `RowCount` FROM `" . $table[0] . "`");

                                $rowCount = (int)($this->result($countSql, 0, "RowCount"));

                                $output .= '{"name":"' . $table[0] . '","rowcount":' . $rowCount . '},';

                            }

                            if (substr($output, -1) == ",")

                                $output = substr($output, 0, -1);

                            $output .= ']';

                        }

                        $output .= '},';

                    }

                    $output = substr($output, 0, -1);

                }

            } else if ($this->adapter == "sqlite") {

                $output .= '{"name": "' . $this->db . '"';

                $tableSql = $this->listTables();

                if ($tableSql) {

                    $output .= ',"items": [';

                    while ($tableRow = $this->fetchArray($tableSql)) {

                        $countSql = $this->query("SELECT COUNT(*) AS 'RowCount' FROM '" . $tableRow[0] . "'");

                        $rowCount = (int)($this->result($countSql, 0, "RowCount"));

                        $output .= '{"name":"' . $tableRow[0] . '","rowcount":' . $rowCount . '},';

                    }

                    if (substr($output, -1) == ",")

                        $output = substr($output, 0, -1);

                    $output .= ']';

                }

                $output .= '}';

            }

        }

        return $output;

    }

    private function error() {

        return $this->errorMessage;

    }

}