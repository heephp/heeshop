<?php
namespace heephp\database;
interface databaseInterface{

    public function getFileds($table);
    public function getKeyFiled($table);
    public function query($sql);
    public function getInsertid();
    public function getOne($sql);
    public function getRow($sql,$type="assoc");
    public function getAll($sql);
    public function select($table,$where,$fields='*',$order='',$skip=0,$limit=0);
    public function insert($table,$data);
    public function delete($table, $where);
    public function update($table,$data,$where,$limit=0);

}