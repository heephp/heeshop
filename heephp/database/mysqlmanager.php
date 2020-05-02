<?php
namespace heephp\database;
/*
 *    mysql表结构处理类
 *    创建数据表，增加，编辑，删除表中字段
 *
 */
class mysqlmanager{
    /*
     * 创建数据库，并且主键是aid
     * table 要查询的表名
     */
    function createTable($table,$key){
        $sql="CREATE TABLE IF NOT EXISTS `$table` (`$key` INT NOT NULL AUTO_INCREMENT primary key)ENGINE = InnoDB;";
        db()->query($sql);
        return $this->checkTable($table);
    }
    /*
     * 检测表是否存在，也可以获取表中所有字段的信息
     * table 要查询的表名
     * return 表里所有字段的信息
     */
    function checkTable($table){
        $sql="desc `$table`";
        $info=db()->getAll($sql);
        return $info;
    }

    /*
     * 检测字段是否存在，也可以获取字段信息(只能是一个字段)
     * table 表名
     * field 字段名
     */
    function checkField($table,$field){
        $sql="desc `$table` $field";
        $info=db()->getAll($sql);
        return $info;
    }

    /*
     * 添加字段
     * table 表名
     * info  字段信息数组 array
     * return 字段信息 array
     */
    function addField($table,$info){
        $sql="alter table `$table` add column ";
        $sql.=$this->filterFieldInfo($info);
        db()->query($sql);
        return $this->checkField($table,$info['name']);
    }

    /*
     * 修改字段
     * 不能修改字段名称，只能修改
     */
    function editField($table,$info){
        $sql="alter table `$table` modify ";
        $sql.=$this->filterFieldInfo($info);
        db()->query($sql);
        return $this->checkField($table,$info['name']);
    }

    /*
     * 字段信息数组处理，供添加更新字段时候使用
     * info[name]   字段名称
     * info[type]   字段类型
     * info[length]  字段长度
     * info[isNull]  是否为空
     * info['default']   字段默认值
     * info['comment']   字段备注
     */
    private function filterFieldInfo($info){
        if(!is_array($info))
            return
                $newInfo=array();
        $newInfo['name']=$info['name'];
        $newInfo['type']=$info['type'];
        switch($info['type']){
            case 'varchar':
            case 'char':
                $newInfo['length']=empty($info['length'])?255:$info['length'];
                $newInfo['isNull']=$info['isNull']=='1'?'NULL':'NOT NULL';
                $newInfo['default']=empty($info['default'])?'':'DEFAULT '.$info['default'];
                $newInfo['comment']=empty($info['comment'])?'':'COMMENT '.$info['comment'];
                break;
            case 'int':
                $newInfo['length']=empty($info['length'])?11:$info['length'];
                $newInfo['isNull']=$info['isNull']=='1'?'NULL':'NOT NULL';
                $newInfo['default']=empty($info['default'])?'':'DEFAULT '.$info['default'];
                $newInfo['comment']=empty($info['comment'])?'':'COMMENT '.$info['comment'];
                break;
            case 'text':
                $newInfo['length']='';
                $newInfo['isNull']=$info['isNull']=='1'?'NULL':'NOT NULL';
                $newInfo['default']='';
                $newInfo['comment']=empty($info['comment'])?'':'COMMENT '.$info['comment'];
                break;
        }
        $sql=$newInfo['name']." ".$newInfo['type'];
        $sql.=(!empty($newInfo['length']))?('('.$newInfo['length'].') '):' ';
        $sql.=$newInfo['isNull'].' ';
        $sql.=$newInfo['default'];
        $sql.=$newInfo['comment'];
        return $sql;
    }

    /*
     * 删除字段
     * 如果返回了字段信息则说明删除失败，返回false，则为删除成功
     */
    function dropField($table,$field){
        $sql="alter table `$table` drop column $field";
        db()->query($sql);
        return $this->checkField($table,$field);
    }

    /*
     * 获取指定表中指定字段的信息(多字段)
     */
    function getFieldInfo($table,$field){
        $info=[];
        if(is_string($field)){
            $info = $this->checkField($table,$field);
        }else{
            foreach($field as $v){
                $info[$v]=$this->checkField($table,$v);
            }
        }
        return $info;
    }

    function droptable($table){
        $sql="drop table `$table`";
        db()->query($sql);
        return !in_array($table,$this->tables());
    }

    function tables(){
        $db=config('db.db_name');
        $sql = 'select TABLE_NAME from information_schema.TABLES where TABLE_SCHEMA =\''.$db.'\'';
        $row = db()->query($sql);
        $tbs=[];
        while ($result=mysqli_fetch_array($row,MYSQLI_ASSOC))
        {
            $tbs[]=$result['TABLE_NAME'];
        }
        return $tbs;
    }

    /**
     * 数据表更名
     * @param $tbname
     * @param $newname
     * @return array|bool|null
     */
    function renametable($tbname,$newname){
        $sql = "alter table `$tbname` rename to `$newname`";
        db()->query($sql);
        return $this->checkTable($newname);
    }
}