<?php
namespace heephp;

class validata{
    private $data;
    private static $last_error;
    public function __construct($_data)
    {
        $this->data=$_data;
    }

    public function must()
    {
        if(empty(trim($this->data)))
            return false;
        return true;
    }

    public function int($min=0,$max=0){
        if($min==0&&$max==0)
            return is_numeric($this->data);
        else {
            if($max==0){
                $max=PHP_INT_MAX;
            }
            return is_numeric($this->data) && $this->data >= $min && $this->data <= $max;
        }
    }

    public function double($wei=0){
        $d=$this->data;
        if($wei==0)
            return is_float($d);

        return is_float(floatval($d))&&strlen(strstr($d,'.'))==$wei+1;
    }

    public function alphaNumDashChinese($min=1,$max=0){
        if($max==0){
            $max='';
        }
        $regex = '/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{'.strval($min).','.strval($max).'}$/u';
        return preg_match($regex,$this->data);
    }

    public function alphaNumDash($min=1,$max=0){
        if($max==0){
            $max='';
        }
        $regex = '/[a-zA-Z0-9_]{'.strval($min).','.strval($max).'}$/';
        return preg_match($regex,$this->data);
    }

    public function alphaNum($min=1,$max=0){
        if($max==0){
            $max='';
        }
        $regex = '/[a-zA-Z0-9]{'.strval($min).','.strval($max).'}$/';
        return preg_match($regex,$this->data);
    }

    public function alpha($min=1,$max=0){ //echo $this->data;
        if($max==0){
            $max='';
        }
        $regex = '/[A-Za-z]{'.$min.','.$max.'}$/';//echo $regex;
        return preg_match($regex,$this->data);
    }

    public function mobile(){
        $regex = '/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/';
        return preg_match($regex,$this->data);
    }

    public function tel(){
        $regex = '/(\d{3}-|\d{4}-)?(\d{8}|\d{7})?/';
        return preg_match($regex,$this->data);
    }

    public function postcode(){
        $regex = '/^[1-9][0-9]{5}$/';
        return preg_match($regex,$this->data);
    }

    public function email(){
        $regex = '/^[a-z0-9]+([._-][a-z0-9]+)*@([0-9a-z]+\.[a-z]{2,14}(\.[a-z]{2})?)$/i';
        return preg_match($regex,$this->data);
    }

    public function qq(){
        $regex = '/^[1-9][0-9]{3,}$/';
        return preg_match($regex,$this->data);
    }

    public function equal($value){
        return $this->data==$value;
    }

    public function notequal($value){
        return $this->data!=$value;
    }

    public function idcard(){
        $regex = '/^[1-9]\d{5}(18|19|([23]\d))\d{2}((0[1-9])|(10|11|12))(([0-2][1-9])|10|20|30|31)\d{3}[0-9Xx]$/';
        return preg_match($regex,$this->data);
    }

    public function url(){
        $regex = '/http[s]?://([w-]+.)+[w-]+(/[w- ./?%&=]*)?/';
        return preg_match($regex,$this->data);
    }

    public function ip(){
        $regex = '/^(?:(?:2[0-4][0-9]\.)|(?:25[0-5]\.)|(?:1[0-9][0-9]\.)|(?:[1-9][0-9]\.)|(?:[0-9]\.)){3}(?:(?:2[0-5][0-5])|(?:25[0-5])|(?:1[0-9][0-9])|(?:[1-9][0-9])|(?:[1-9]))$/';
        return preg_match($regex,$this->data);
    }

    public function chinese(){
        $regex = '/[\x7f-\xff]+/';
        return preg_match($regex,$this->data);
    }

    /*
     * 验证唯一
     * @value 需要验证的数据
     * @table 数据所在表
     * @field 要验证的字段
     * @key key字段
     * @id 当前记录key字段的值
     * */
    public function unique($value,$table,$field,$key,$id){
        $where = '';
        if(!empty($id)){
            $where=" and `$key`<>'$id'";
        }

        $db= db();
        $row = $db->getRow("select * from ".config('db.table_prefix')."$table where `$field`='$value'$where");
        return empty($row);
    }

    public function regex($regex){
        return preg_match($regex,$this->data);
    }

    public static function get_error(){
        return validata::$last_error;
    }

    public static function set_error($error){
        validata::$last_error=$error;
    }

    public static function showerror(){
        $error = validata::$last_error;
        include config('validata_error_page');
        exit;
    }
}