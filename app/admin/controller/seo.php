<?php
namespace app\admin\controller;

class seo extends adminBase
{
    public function edit(){

        $cof = \model('config');
        $cof->select();

        $m=[];
        foreach ($cof->data as $item){
            $m[$item['name']]=$item['value'];
        }
        $this->assign('m',$m);
        return $this->fetch();
    }

    public function save(){
        $data=request('post.');
        foreach ($data as $k=>$v) {
            if($k=='website_keyword'){
                $v = str_replace([',',';',' ','，','.','。','；',':','：'],'|',$v);
            }
            conf($k, $v);
        }
        return $this->redirect('edit');


    }
}