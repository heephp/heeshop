<?php

namespace app\admin\controller;

use heephp\bulider\form;
use heephp\bulider\table;
use heephp\validata;

class info extends adminBase
{

    public function __construct()
    {
        parent::__construct();
    }

    public function manager($category_id)
    {
        $cate = model('category');
        $cate->get($category_id);
        $cate->model();
        $d=$cate->data;
        if($d['model']['is_sys']=='1'){
            return $this->redirect('/'.APP.'/'.$d['model']['table_name'].'/manager');
        }else{
            $this->bulider_table($d['model']['model_table_id'],$category_id);
        }
        $this->assign('category_id',$category_id);
        return $this->fetch();
    }

    public function add($category_id){
        $cate = model('category');
        $cate->get($category_id);
        $cate->model();
        $d=$cate->data;
        if($d['model']['is_sys']=='1'){
            return $this->redirect('/'.APP.'/'.$d['model']['table_name'].'/add/');
        }else{
            $this->bulider_form($d['model']['model_table_id'],0,$category_id);
        }
        $this->assign('category_id',$category_id);
        return $this->fetch('edit');
    }

    public function edit($category_id,$id){

        $cate = model('category');
        $cate->get($category_id);
        $cate->model();
        $d=$cate->data;
        if($d['model']['is_sys']=='1'){
            return $this->redirect('/'.APP.'/'.$d['model']['table_name'].'/edit/'.$id);
        }else{
            $this->bulider_form($d['model']['model_table_id'],$id,$category_id);
        }

        $this->assign('category_id',$category_id);
        return $this->fetch();
    }

    public function delete($category_id,$id){

        $cate = model('category');
        $cate->get($category_id);
        $cate->model();
        $d=$cate->data;
        if($d['model']['is_sys']=='1'){
            return $this->redirect('/'.APP.'/'.$d['model']['table_name'].'/delete/'.$id);
        }else {

            $mt = model('model_table');
            $mt->get($d['model']['model_table_id']);
            $tbname = $mt->data['name'];

            $model = modeluser($tbname);
            $result = $model->delete($id);
            if($result){
                return $this->success('删除成功！',url('manager',$category_id));
            }else{
                return $this->error('删除失败！');
            }

        }
    }

    public function save(){

        $data = request('post.');
        $category_id=$data['category_id'];

        $cate = model('category');
        $cate->get($category_id);
        $cate->model();
        $d=$cate->data;
        $model_table_id=$d['model']['model_table_id'];
        if($d['model']['is_sys']=='1'){
            return $this->redirect('/'.APP.'/'.$d['model']['table_name'].'/manager');
        }

        //取出表 ，并从表中读取数据
        $mt = model('model_table');
        $mt->get($model_table_id);
        $tbname=$mt->data['name'];

        //判断字段中是否有上传文件的字段 并上传
        $mtf=model('model_table_field');
        $fields = $mtf->where('model_table_id='.$model_table_id)->select();
        $upload = ['dir'=>conf('upload_dir'),'size'=>conf('upload_size'),'ext'=>explode(',',conf('upload_ext')),'file_name'=>conf('upload_file_name')];
        for($k=0;$k<count($fields);$k++){//var_dump($data[$fields[$k]['field_name']]);
            if($fields[$k]['input_type']=='file'){

                $info=uploadfile($fields[$k]['field_name'],$upload['ext'],$upload['size'],$upload['dir'],$upload['file_name']);
                if(!empty($info['error'])){
                    return $this->error($info['error'].':'.$fields[$k]['field_name']);
                }elseif(!empty($info)){
                    $data[$fields[$k]['field_name']]=$info['fullpath'];
                }
            }
        }

        //从表中获取主键 并 保存
        $dm = modeluser($tbname);
        $keyfield = $dm->key;

        $result = 0;
        //如果主键值为空 那么插入
        if(empty($data[$keyfield])){
            $result = $dm->insert($data);
        }else{
            $result = $dm->update($data);
        }
        if(!empty($result)){
            return $this->success('保存成功！',url('manager',$category_id));
        }else{
            return $this->error('保存失败！');
        }

    }

    private function bulider_table($model_table_id,$category_id){

        //取出表 ，并从表中读取数据
        $mt = model('model_table');
        $mtdata = $mt->get($model_table_id);
        $tbname = $mtdata['name'];
        $allow_manager =[];
        //取出允许显示在后台管理表格的字段
        if(!empty($mtdata['allow_manager']))
            $allow_manager = explode(',',$mtdata['allow_manager']);

        $dm = modeluser($tbname);
        $dm->where('category_id='.$category_id)->page;

        //读取标题，并构造列
        $mtf = model('model_table_field');
        $mtf->where("model_table_id=$model_table_id")->select();
        $fields = array_filter($mtf->data,function ($val) use($allow_manager){
            return empty($allow_manager)||in_array($val['field_name'],$allow_manager);
        });

        //限制显示长度的列
        $column_len=[];
        //显示为链接的列
        $column_link=[];

        $items=[];
        foreach ($fields as $f) {

            if($f['field_name']!='category_id')
                $items[]=[$f['field_title'],$f['field_name']];

            //判断列类型
            if($f['input_type']=='file')
                $column_link[]=$f['field_name'];
            if($f['input_type']=='editor')
                $column_len[]=$f['field_name'];

        }

        $table = new table();
        $table->setClass(['table','table-hover','table-border']);
        $table->setLenColumns($column_len);
        $table->setLinkColumns($column_link);
        $table->setColum($items);
        $table->setData($dm->data);
        $table->setBtn('编辑','edit',['category_id','id']);
        $table->setBtn('删除','delete',['category_id','id']);
        $table->bulider();

        $this->assign('table',$table->show());

    }


    private function bulider_form($model_table_id,$id=0,$category_id=0){

        //取出表 ，并从表中读取数据
        $mt = model('model_table');
        $tbname = $mt->where("model_table_id=$model_table_id")->getByname();

        $dm = modeluser($tbname);
        $keyfield = $dm->key;
        $dm->get($id);
        $data = $dm->data;

        //读取字段，并构造表单
        $mtf = model('model_table_field');
        $mtf->where("model_table_id=$model_table_id")->select();
        $fields = $mtf->data;

        $form =new form(url('save'),'post');
        $form->hidden('category_id',$category_id);
        $i=0;
        foreach ($fields as $f){

            if($f['field_name']==$keyfield||$f['field_name']=='category_id')
                $form->hidden($f['field_name'],$data[$f['field_name']]??'');

            switch($f['input_type']) {
                case 'select':
                    $form->select($f['field_title'], $f['field_name'], explode(',', $f['input_type_values']), $data[$f['field_name']]??'');
                    break;
                case 'checkboxs':
                    $form->checkboxs($f['field_title'], $f['field_name'], explode(',', $f['input_type_values']), $data[$f['field_name']]??'');
                    break;
                case 'radios':
                    $form->radios($f['field_title'], $f['field_name'], explode(',', $f['input_type_values']), $data[$f['field_name']]??'');
                    break;
                case 'textarea':
                    $form->textarea($f['field_title'], $f['field_name'],$data[$f['field_name']]??'');
                    break;
                case 'editor':
                    $form->ueditor($f['field_title'], $f['field_name'],html_entity_decode($data[$f['field_name']]??''));
                    break;
                case 'file':
                    $form->file($f['field_title'], $f['field_name'],$data[$f['field_name']]??'');
                    break;
                default:
                    if(!empty($f['input_type']))
                        call_user_func_array([$form,$f['input_type']],[$f['field_title'], $f['field_name'],$data[$f['field_name']]??'',$f['field_title']]);

            }

            $i++;
        }
        $form->submit();
        $form->rest();
        $this->assign('form',$form->show());

    }
}