<?php

namespace app\admin\controller;

//表管理类
use app\home\model\config;
use heephp\bulider\form;
use heephp\database\mysqlmanager;
use heephp\sysExcption;
use mysql_xdevapi\Exception;

class model_table extends adminBase{

    private $user_model_pre='';

    public function __construct()
    {
        parent::__construct();
        $this->user_model_pre = config('user_model_prefix');
    }

    public function manager()
    {
        $tb=model('model_table');
        $tb->page();
        $tb->create_user();
        $this->assign('list',$tb->data);
        $this->assign('pager',$tb->pager['show']);
        return $this->fetch();
    }

    public function add()
    {
        $this->builder_form();
        return $this->fetch('edit');
    }

    public function edit($id){

        $tb=model('model_table');
        $m = $tb->get($id);
        if(empty($m)){
            return $this->error('数据表不存在！');
        }

        $this->builder_form($id);
        return $this->fetch();

    }

    private function builder_form($model_table_id=0,$fieldscount = 1)
    {
        $mtf = model('model_table_field');
        $mt = model('model_table');
        $m = empty($model_table_id)?'':$mt->get($model_table_id);

        $fields = [];
        if (!empty($m)) {
            $sfields = db()->getFileds($this->user_model_pre.$m['name']);
            $fields = array_filter($sfields,function ($var){
                return $var['Field']!='create_time'&&$var['Field']!='update_time';
            });
            $fieldscount = count($fields) > 0 ? count($fields) : $fieldscount;
        }else
            $fields[]=[];

        $f = new form(url('save'), 'post');
        $f->hidden('model_table_id',$model_table_id);
        $f->rowStart()->rowInput('表名：', 'tablename', $m['name']??'', 2)->rowEnd();

        $i=0;
        foreach ($fields as $fi){
            //从表中读取字段的输入框类型和选择值列表
            $mfinfo = empty($model_table_id) || empty($fi['Field']) ? '' : $mtf->find("model_table_id=$model_table_id and field_name='" . $fi['Field'] . "'");
            $type = explode('(', $fi['Type']);
            $f->rowStart()
                ->rowInput('标题：', 'input_title[]', $mfinfo['field_title'] ?? '', 1)
                ->rowInput('字段名：', 'filed[]', $fi['Field'], 1)
                ->rowSelect('类型：', 'type[]', ['varchar' => 'varchar', 'int' => 'int', 'text' => 'text'], $type[0], 1)
                ->rowInput('长度：', 'len[]', substr($type[1] ?? '', 0, strlen($type[1]) - 1), 1)
                ->rowSelect('isNuLL', 'isnull[]', ['0' => '否', '1' => '是'], $fi['Null'] == 'YES' ? '1' : '0', 1)
                ->rowSelect('主键', 'key[]', ['1' => '是', '0' => '否'], $fi['Key'] == 'PRI' ? '1' : '0', 1)
                ->rowInput('默认值', 'default[]', $fi['Default'], 1)
                ->rowInput('备注', 'comment[]', $fi['Comment'], 2)
                ->rowSelect('输入框类型', 'input_type[]', ['text' => 'text', 'number' => 'number', 'email' => 'email', 'date' => 'date', 'time' => 'time', 'month' => 'month', 'week' => 'week', 'datetime' => 'datetime', 'datetime_local' => 'datetime_local', 'url' => 'url', 'textarea' => 'textarea', 'select' => 'select', 'radios' => 'radios', 'checkboxs' => 'checkboxs', 'editor' => 'editor','file'=>'file'], $mfinfo['input_type'] ?? '', 1)
                ->rowInput('数据列表(,分隔)：', 'input_type_values[]', $mfinfo['input_type_values'] ?? '', 2)
                ->rowEnd();
            $i++;
        }
        $f->customer('<div id="addfield"></div>');
        $f->submit()
            ->button('添加字段','addfield()','info');
        $this->assign('form', $f->show());
    }

    public function save()
    {
        $data = request('post.');// var_dump($data);exit;

        $user_model_pre=$this->user_model_pre;
        $tbname = $data['tablename'];
        $tb_pre=config('db.table_prefix');
        $tb=$tb_pre.$user_model_pre.$tbname;

        $mm = new mysqlmanager();
        $tables = $mm->tables();
        $true_table_exic = in_array($tb,$tables);//是否表实体存在

        $mtb=model('model_table');
        if(empty($data[$mtb->key]))
            $m=[];
        else
            $m = $mtb->get($data[$mtb->key]);//查找模型表中记录

        if(empty($m)){
            $m[$mtb->key] =$mtb->insert(['name'=>$tbname,'create_users_id'=>request($this->session_id_str)]);
            if(empty($m[$mtb->key])){
                return $this->error('新建表失败！');
            }
            $m['name'] = $tbname;
        }else {
            $effort = $mtb->update(['name' => $tbname], [$mtb->key => $data[$mtb->key]]);

            if (($m['name'] != $tbname) && $true_table_exic) {
                if ($effort > 0) {
                    $mm->renametable($tb_pre . $user_model_pre . $m['name'], $tb);
                } else {
                    return $this->error('修改数据表名失败！');
                }
            }

        }


        $key = '';
        $info = [];

        $count = count($data['key']);
        for ($i = 0; $i < $count; $i++) {
            if (!empty($data['key'][$i])) {

                if(!empty($key))
                    return $this->error('有多个主键！');

                $key = $data['filed'][$i];//var_dump($data['isnull'][$i]);exit;
                //continue;
            }
            if (!empty($data['filed'])) {
                $s['name'] = $data['filed'][$i];
                $s['type'] = empty($data['type'][$i]) ? 'varchar' : $data['type'][$i];
                $s['length'] = $data['len'][$i];
                $s['isNull'] = $data['isnull'][$i];
                $s['default'] = $data['default'][$i];
                $s['comment'] = $data['comment'][$i];
                $s['input_title'] = $data['input_title'][$i];
                $s['input_type'] = $data['input_type'][$i];
                $s['input_type_values'] =  $data['input_type_values'][$i];
                $info[] = $s;
            }
        }

        if(empty($key)){
            return $this->error('缺少主键！');
        }

        if(!$true_table_exic) {
            $re = $mm->createTable($tb, $key);
            $mm->addField($tb, ['name'=>'category_id','type'=>'int','length'=>11]);
            $mm->addField($tb, ['name'=>'create_time','type'=>'int','length'=>11,'isNull'=>'NO']);
            $mm->addField($tb, ['name'=>'update_time','type'=>'int','length'=>11,'isNull'=>'NO']);
        }

        $finfo = array_column($mm->checkTable($tb),'Field');

        $mtbf = model('model_table_field');
        foreach ($info as $f) {
            //判断表中是否已经存在字段
            if(!in_array($f['name'],$finfo))
                $mm->addField($tb, $f);
            else
                $mm->editField($tb,$f);

            //修改输入框类型和列表
            //判断字段是否在表中有记录
            $fd = $mtbf->find('`model_table_id`=\''.$m['model_table_id'].'\' and `field_name`=\''.$f['name'].'\'');
            //var_dump($f);
            $mtdata = ['model_table_id'=>$m['model_table_id'],'field_title'=>$f['input_title'],'field_name'=>$f['name'],'input_type'=>$f['input_type'],'input_type_values'=>$f['input_type_values']];
            if(empty($fd)){
                $mtbf->insert(array_merge($mtdata,['create_users_id'=>request($this->session_id_str)]));
            }else{
                $mtbf->update($mtdata,[$mtbf->key => $fd[$mtbf->key]]);
            }
        }
        //exit;
        return $this->rediect('manager');

    }
    public function delete($id){

        $tb=model('model_table');
        $tbname = $tb->getByname($tb->key.'='.$id);
        $isdel = $tb->delete($id);
        if($isdel){
            $mm = new mysqlmanager();
            $reslut = $mm->droptable(config('db.table_prefix').$this->user_model_pre.$tbname);
            if($reslut){
                return $this->success('成功删除表！',url('manager'));

            }else {
                return $this->error('删除表失败！');
            }
        }

    }

}