<?php
namespace app\home\controller;
use heephp\bulider\form;
use heephp\bulider\table;
use  heephp\controller;
use heephp\formbulider;
use heephp\route;

class index extends controller{

    public function __construct()
    {
        parent::__construct();

        //读取配置
        $config=model('config');
        $webconfig = $config->all();
        $this->assign('c',$webconfig);

        //读取菜单
        $lg = model("link_group");
        $lg->select();

        $link = model('link');
        foreach ($lg->data as $l){
            $ls = $link->select('parent_id<1 and link_group_id='.$l['link_group_id'],'ord asc');
            $this->assign($l['tag'],$ls);
        }

    }


    public function  index(){

        return $this->fetch();
    }

    public function contact(){

        return $this->fetch();
    }

    public function test()
    {
        /*$pic = ROOT.'/public/upload/20200425/1587782677251926.jpg';
        $pic_s = ROOT.'/public/upload/20200425/1587782677251926_small.jpg';
        $image = new \heephp\heeimages();
        $image->fromFile($pic)->autoOrient()->resize(80,80)->flip('y')                                 // flip horizontally
        ->colorize('DarkBlue')                      // tint dark blue
        ->border('black', 10)// add a 10 pixel black border
            ->text('abcdefg',['fontFile'=>ROOT.'/public/assets/fonts/arial.ttf'])
        //->overlay('watermark.png', 'bottom right')  // add a watermark image
        ->toFile('new-image.png', 'image/png')      // convert to PNG and save a copy to new-image.png
        ->toScreen();*/

        /*$form = new \heephp\bulider\form(url('manager'));
        $form->set_row(false);
        for($i=0;$i<10;$i++) {
            $form->text("标题", 'name1', 'default1')
                ->date('日期', 'd1', '2020-02-01')
                ->radios('选择', 'x' . $i, [['label' => 'x1', 'value' => '1'], ['label' => 'x2', 'value' => '2']], 1)
                ->checkboxs('选择', 'x' . $i, [['label' => 'x1', 'value' => '1'], ['label' => 'x2', 'value' => '2']], [1, 2])
                ->select('选择', 's1', ['1' => 's1', '2' => 's2'], '2', true)
                ->rowStart()->rowInput('日期', 'd1', '', 3)->rowInput('数字', 123, 123, 3)->rowSelect('abc', 'abc1', [], '')->rowEnd()
                ->ueditor('ueditor', 'u' . $i)
                ->file('f1', 'n1')
                ->submit()->rest();

        $this->assign('form1', $form->show());
*/

        //echo route::set('/admin/index/index');

        /*$link = model('link');
        $link->select();

        $table = new table();
        $table->setClass(['table','table-hover','table-sm']);
        $table->setHeaderClass('thead-light');
        $table->setColum(['Id', 'link_id']);
        $table->setColum(['标题', 'title']);
        $table->setColum(['链接', 'url']);
        $table->setBtn('编辑','edit',['link_id']);
        $table->setBtn('删除','delete',['link_id']);
        $table->setData($link->data);
        $table->bulider();
        $this->assign('table', $table->show());
        return $this->fetch('index');*/




    }

}