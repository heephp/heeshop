<?php
namespace heephp;

/*
 * 模型的关系
 * */

use mysql_xdevapi\Exception;

class relation{

    private $model;//当前模型
    private $rmodel;//关系模型
    private $rename='';//别名
    private $hasone=false;
    private $hasmore=false;
    private $moretomore=false;
    private $belong=false;
    private $key='';
    private $fkey='';//外键
    private $mid_table='';//中间表

    //关系模型需要读的方法列表
    private $rmodel_methods;
    //关系模型的排序
    private $rmodel_order;

    protected $db=null;
    //结果数据
    protected $data=[];

    /*
     *构造函数
     * @model当前模型
     * @type 关联类型  hasone hasmore belong moretomore
     * @rtable 关联的表名称
     * @key 本表关联字段
     * @fkey 关联表的关联字段
     * @rename 重命名结果集 默认为关联表名
     * @mid_table 中间表名
     */
    public function __construct($model,/*$type,*/$rtable,$key,$fkey,$rename='',$mid_table='')
    {
        $this->model=$model;
        $this->rmodel=model($rtable);
        $this->rename=$rename;

        $this->key=$key;
        $this->fkey=$fkey;
        $this->mid_table=$mid_table;

        $this->db=db();
    }



    /*
     *
     *属于一个关系
     * */
    public function belong(){

        $this->belong=true;

        $itemname = empty($this->rename)?$this->rmodel->table:$this->rename;
        $tdata = $this->model->data;

        //如果数据为空直接返回
        if(empty($tdata))
            return $this;


        //如果是单行记录
        if($this->issingleline($tdata)) {
            //如果无值则不调用
            if(!empty($tdata[$this->key])) {

                $this->rmodel->where("`$this->fkey`='" . $tdata[$this->key] . "'")->find();
                $this->call_rmodel_methods();

                $tdata[$itemname] = $this->rmodel->data;
            }

        }else{

            //如果多条记录
            for($i=0;$i<count($tdata);$i++){

                //如果无值则不调用
                if(!empty($tdata[$i][$this->key])) {
                    $this->rmodel->where("`$this->fkey`='".$tdata[$i][$this->key]."'")->find();
                    $this->call_rmodel_methods();

                    $tdata[$i][$itemname] = $this->rmodel->data;
                }
            }

        }
        $this->model->data = $tdata;

        return $this;
    }



    /*
     *
     * 一对多查询
     *
     * */
    public function hasmore($splitpage=true,$onlysoftdel=false){

        $this->hasmore=true;

        $pageparm = 'page-'.$this->rmodel->table;
        $method = $splitpage?'page':'select';
        $tdata = $this->model->data;

        //是否有别名
        $itemname = empty($this->rename)?$this->rmodel->table:$this->rename;

        //如果数据为空直接返回
        if(empty($tdata))
            return $this;

        //如果是单行记录
        if ($this->issingleline($tdata)) {

            //$parms = ['`'.$this->fkey.'`=\''.$tdata[$this->key].'\'', , '*', $onlysoftdel, $pageparm];
            //call_user_func_array([$this->rmodel, $method], $parms);
            $this->rmodel
                ->where('`'.$this->fkey.'`=\''.$tdata[$this->key].'\'')
                ->order(empty($this->rmodel_order)?"$this->fkey asc":$this->rmodel_order)
                ->pageparm($pageparm)
                ->softdel($onlysoftdel)
                ->$method();

            $this->call_rmodel_methods();

            $tdata[$itemname] = $this->rmodel->data;


        } else {

            for ($i = 0; $i < count($tdata); $i++) {

                //$parms = ['`'.$this->fkey.'`=\''.$tdata[$i][$this->key].'\'', empty($this->rmodel_order)?"$this->fkey asc":$this->rmodel_order, '*', $onlysoftdel, $pageparm];
                //call_user_func_array([$this->rmodel, $method], $parms);
                $this->rmodel
                    ->where('`'.$this->fkey.'`=\''.$tdata[$i][$this->key].'\'')
                    ->order(empty($this->rmodel_order)?"$this->fkey asc":$this->rmodel_order)
                    ->pageparm($pageparm)
                    ->softdel($onlysoftdel)
                    ->$method();

                $this->call_rmodel_methods();

                $tdata[$i][$itemname] = $this->rmodel->data;

            }

        }

        $this->model->data=$tdata;
        return $this;

    }


    /*
     *
     * 多对多查询
     *
     * */
    public function moretomore($splitpage=false,$onlysoftdel=false){
        $this->moretomore=true;

        //$pageparm = 'page-'.$this->mid_table;
        //$method = $splitpage?'page':'select';
        $tdata=$this->model->data;

        //是否有别名
        $itemname = empty($this->rename)?$this->rmodel->table:$this->rename;

        //如果数据为空直接返回
        if(empty($tdata))
            return $this;

        //如果是单行记录
        if ($this->issingleline($tdata)) {

            //从中间表读出关联id列表
            $midmodel=model($this->mid_table);
            $methodname = 'getBy'.$this->fkey;
            $list = $midmodel->where($this->key."='".$tdata[$this->key]."'")->order(empty($this->rmodel_order)?'':$this->rmodel_order)->$methodname();

            //从关联表读取数据
            if(!is_array($list)){

                $this->rmodel->where("`$this->fkey`='".$list."'")->find();
                $this->call_rmodel_methods();

                $d=$this->rmodel->data;
                if(!empty($d))
                    $tdata[$itemname]=[$this->rmodel->data];

            }else{
                for($i = 0; $i < count($list); $i++) {
                    $it=$list[$i];
                    $this->rmodel->where("`$this->fkey`='".$it."'")->find();
                    $this->call_rmodel_methods();

                    $d=$this->rmodel->data;
                    if(!empty($d))
                        $tdata[$itemname][]=$this->rmodel->data;

                }
            }


        }else{

            $midmodel=model($this->mid_table);
            $methodname = 'getBy'.$this->fkey;

            for($i=0;$i<count($tdata);$i++){

                $di=$tdata[$i];

                //从中间表读出关联id列表
                $list = $midmodel->where('`'.$this->key."`='".$di[$this->key]."'")->$methodname();

                if(empty($list))
                    continue;

                //从关联表读取数据
                if(!is_array($list)){
                    $this->rmodel->get($list);
                    $this->call_rmodel_methods();

                    $d=$this->rmodel->data;
                    if(!empty($d))
                        $di[$itemname]=$this->rmodel->data;
                }else{

                    $this->rmodel->whereIn($this->fkey,$list)->select();
                    $this->call_rmodel_methods();

                    $d=$this->rmodel->data;
                    if(!empty($d))
                        $di[$itemname]=$this->rmodel->data;
                }

                $tdata[$i]=$di;

            }



        }

            $this->model->data=$tdata;

        return $this;

    }



    private function update($data){

        $tdata = $this->model->data;

        if($this->belong){
            if(!$this->issingleline($tdata)){
                throw new sysExcption('对一更新数据，仅支持当前模型一条相关数据'.$this->model->table.'关联'.$this->rmodel->table);
            }else{
                $data[$this->fkey]=$tdata[$this->fkey];
                if(empty($data[$this->rmodel->key]))
                    return $this->rmodel->insert($data);
                else
                    return $this->rmodel->update($data);
            }
        }else if($this->hasmore){
            if($this->issingleline($tdata)) {
                $data[$this->fkey]=$tdata[$this->fkey];
                if(empty($data[$this->rmodel->key]))
                    return $this->rmodel->insert($data);
                else
                    return $this->rmodel->update($data);
            }else{
                $rearr = [];
                for($i=0;$i<count($tdata);$i++){
                    $data[$this->fkey]=$tdata[$i][$this->fkey];

                    if(empty($data[$this->rmodel->key]))
                        $rearr[] =  $this->rmodel->insert($data);
                    else
                        $rearr[] =  $this->rmodel->update($data);
                }
                return $rearr;
            }
        }

    }


    public function save($data){
        $tdata = $this->model->data;
        if($this->belong){

        }elseif ($this->hasmore){
            //一对多
            if(is_array($data)) {

                if ($this->issingleline($tdata)) {
                    //单条记录
                    $this->update($data);

                }else{

                    //多条记录
                    foreach ($data as $item){
                        $this->update($item);
                    }

                }

                return;
            }

            throw new sysExcption('一对多保存数据必须为单条数组或多条数组记录');


        }elseif($this->moretomore){

            //多对多
            //将数组转为字符串列表
            if(is_array($data)){

                if($this->issingleline($tdata)){

                    if(array_key_first($data)==0){
                        //如果是id列表
                        $data = implode(',',$data);
                    }else{
                        //如果是单条数据
                        $data =$data[$this->fkey];
                    }

                }else{
                    //如果是多条记录
                    $arr = array_column($data,$this->fkey);
                    $data = implode(',',$arr);
                }

            }

                //如果为字符串 用,分割的Id
                //清除中间表数据库中没有
                $midmodel=model($this->mid_table);
                $sql= '`'.$this->key."`='".$tdata[$this->key]."'";
                if(!empty($data))
                    $sql.=" and $this->fkey not in (".$data.")";
                $midmodel->where($sql)->delete();

                //新增中间表没有的数据
                $rearr = [];
                $ds = explode(',',$data);
                foreach ($ds as $item) {
                    if(empty($item))
                        continue;
                    $rearr = $midmodel->insert([$this->key => $tdata[$this->key], $this->fkey => $item]);
                }

                return $rearr;


        }
    }

    /**
     * 设置调用关系模型需要调用的相关方法；
     * @param array|string $methods 方法列表
     * 需要在调用belong hasmore moretomore之前调用
     *  不设置则不需要调用
     */
    public function set_rmodel_methods($methods){
        $this->rmodel_methods=$methods;
    }

    /**
     * 设置关系模型的排序方式
     * @param $ord 排序字符串
     */
    public function set_rmodel_order($ord){
        $this->rmodel_order=$ord;
    }

    /**
     * 调用关系模型的相关方法
     */
    private function call_rmodel_methods(){

        if(empty($this->rmodel_methods))
            return;

        if(!is_array($this->rmodel_methods)){
            if(!method_exists($this->rmodel,$this->rmodel_methods)){
                throw new sysExcption('模型'.$this->model.'中关系模型'.$this->rmodel.'需要调用的方法：'.$this->rmodel_methods.'不存在');
                exit;
            }
            call_user_func_array([$this->rmodel,$this->rmodel_methods],[]);

        }else{
            foreach ($this->rmodel_methods as $ms){
                if(!method_exists($this->rmodel,$ms)){
                    throw new sysExcption('模型'.$this->model.'中关系模型'.$this->rmodel.'需要调用的方法：'.$ms.'不存在');
                    exit;
                }
                call_user_func_array([$this->rmodel,$ms],[]);
            }
        }
    }

    /**
     * 是否是单行数组
     * @param $arr
     * @return true|false
     */
    private function  issingleline($arr){
        //echo array_key_first($arr)===0;exit;
        if(count($arr)>1){
            return array_key_first($arr)===0?false:true;
        }

        return false;

    }

}