<?php
namespace app\admin\controller;

use heephp\sysExcption;
use heephp\validata;

class grabs extends adminBase
{
    function manager()
    {

        $grabs = model('grabs');
        $list = $grabs->order('create_time desc')->select();
        $this->assign('list',$list);
        return $this->fetch();

    }

    function add(){
        $cate = model('category');
        $cate->select();
        $this->assign('plist',$cate->data);

        return $this->fetch('edit');
    }

    function edit($id){
        $cate = model('category');
        $cate->select();
        $this->assign('plist',$cate->data);

        $grabs = model('grabs');
        $m = $grabs->get($id);
        $this->assign('m',$m);
        return $this->fetch();
    }

    function save(){
        $data =request('post.');
        $data['users_id']=request($this->session_id_str);
        foreach ($data as $k=>$v){
            $data[$k]=exhtml($data[$k]);
        }
        $grabs = model('grabs');
        $lastid = $grabs->save($data);
        if($lastid)
            return $this->success('保存成功！',url('grabs/manager'));
        else
            return $this->error('保存失败！');
    }

    function get_list($id,$page=0){
        $userid = request($this->session_id_str);
        $grabs = model('grabs');
        $m = $grabs->get($id);
        $filterlinks = explode(PHP_EOL,$m['filterlinks']);//要过滤的网址

        if($page==0)
            $page = $m['startpage'];

        $msg = '当前页：'.$page.'<br>';

        $url = str_replace('[p]',$page,$m['urls']);//exit();

        //获取html
        $html = getcurl($url)['body'];//var_dump($url);exit();
        //获取列表链接
        //列表区域中找链接
        $linkcont = $this->getNeedBetween($html,$m['linkstart'],$m['linkend']);

        if($linkcont===0){
            $s2 = '链接列表区域未找到！';
            $this->log($id,$s2);
            return $this->reinfo($s2,'get_list',[$id,$page]);
        }

        $mgl = model('grabs_list');
        //正则
        $preg='/<a .*?href="(.*?)".*?>/is';
        preg_match_all($preg,$linkcont,$array2);//var_dump($array2[1]);
        $ulist = array_map('trim',array_unique($array2[1]));//var_dump($ulist);exit();
        foreach($ulist as $u)//逐个输出超链接地址
        {
            //$u = trim($u);

            if(in_array($u,$filterlinks)||trim($u)=='/'||trim($u)=='#'||strpos(trim($u),'javascript')!==false||empty(trim($u))) {
                continue;
            }
            if(strpos($u,'http://')===false&&strpos($u,'https://')===false){
                $u = $m['baseurl'].$u;//var_dump($u);exit();
            }
           // $r = $mgl->where("grabs_id='$id' and url='$url' and users_id='$userid' and isread=0")->save(['grabs_id'=>$id,'url'=>$u,'create_time'=>time(),'users_id'=>$userid,'isread'=>0]);


            $counturl = $mgl->where("grabs_id='$id' and url='$url' and users_id='$userid' and isread=0")->count('*','c')->value('c');
            if($counturl<1)
                $mgl->insert(['grabs_id'=>$id,'url'=>$u,'create_time'=>time(),'users_id'=>$userid,'isread'=>0]);
            else
                $mgl->update(['grabs_id'=>$id,'url'=>$u,'create_time'=>time(),'users_id'=>$userid,'isread'=>0]);


            $msg.= '获取到链接地址：'.$u.'<br>';
        }

        if($page==intval($m['endpage'])){
            return $this->reinfo($msg.'列表页采集完毕','get_detail',$id);
        }else
        {
            return $this->reinfo($msg.'准备采集下一页','get_list',[$id,$page+1]);
        }

    }

    function get_detail($id,/*$page=0,*/int $istest=0){
        $msg = '开始获取详细页<br>';
        $userid = request($this->session_id_str);

        $grabs = model('grabs');
        $mg = $grabs->get($id);

        $grabslist = model('grabs_list');
        $list = $grabslist->where('isread=0 and grabs_id='.$id.' and users_id='.$userid)->limit(/*$page*$mg['epage']).','.*/$mg['epage'])->select();
        if(empty($list)){
            return '采集结束';
        }
        $mgd = model('grabs_detail');
        $ma = model('article');

        foreach ($list as $item){
            $url = $item['url'];
            $html = trim(getcurl($url)['body']);if(empty($html)){ $this->log($id,'采集'.$url.'时，html返回空后跳过该页'); continue;}
            //查找标题
            $title = $this->getNeedBetween($html,$mg['titlestart'],$mg['titleend']);//var_dump($title);exit;
            if(empty($title)){
                $this->log($id,'采集'.$url.'时，title返回空后跳过该页');
                continue;
            }
            //查找作者
            $author = $this->getNeedBetween($html,$mg['authorstart'],$mg['authorend']);
            //查找时间
            $tim =  $this->getNeedBetween($html,$mg['timestart'],$mg['timeend']);
            if(empty($tim))
                $tim = time();
            else
                $tim = strtotime($tim);

            //查找内容
            $cont = $this->getNeedBetween($html,$mg['contentstart'],$mg['contentend']);//var_dump(mb_detect_encoding($cont,['gbk','gb2312','utf-8']));//var_dump($title);var_dump($cont===0);//exit;
            if(empty($cont)){
                $msg.='url'.$url.' '.$title.'内容为空';
                $this->log($id,$msg);
                continue;
            }else{

                //获取首图
                $imgpreg = "/<img (.*?) src=\"(.+?)\".*?>/";
                preg_match($imgpreg,$cont,$img);
                $mycount=count($img)-1;
                $firstpic = $img[$mycount];

                if(strpos($firstpic,'http://')===false&&strpos($firstpic,'https://')===false){
                    $firstpic = $mg['baseurl'].$firstpic;//var_dump($u);exit();
                }

                //过滤html tags
                $tags = '<'.implode('><',explode(' ',$mg['filterhtml'])).'>';
                $cont = strip_tags($cont,$tags);

                //判断编码
                $encode = mb_detect_encoding($cont,['gbk','gb2312','utf-8']);
                if($encode!='UTF-8')
                    $cont=iconv($encode,"UTF-8",$cont);
            }

            try {
                $lastid = $mgd->insert(['grabs_id' => $id, 'url' => $url, 'title' => addslashes($title), 'author' => addslashes($author), 'time' => addslashes($tim), 'content' => addslashes($cont), 'firstpic' => $firstpic, 'create_time' => time(), 'users_id' => $userid]);
                if ($istest < 1) {
                    //如果是测试采集 则不需要入库
                    $lastid2 = $ma->where("category_id ='" . $mg['category_id'] . "' and `title`='" . addslashes($title) . "'")->save(['category_id' => $mg['category_id'], 'title' => addslashes($title), 'author' => addslashes($author), 'create_time' => $tim, 'context' => addslashes($cont), 'first_pic' => $firstpic, 'create_users_id' => $userid]);
                    if (!$lastid2) {
                        $this->log($id, '插入到采集时栏目已存在相同标题或未保存！' . $title . $url);
                    }
                }
                $grabslist->update(['grabs_list_id'=>$item['grabs_list_id'],'isread'=>1]);

            }catch (sysExcption $ex){
                $this->log($id,'插入详细采集记录时出错:'.$ex->getMessage().'标题：'.$title.$url);
            } finally {
                if(!$lastid){
                    $this->log($id,'插入详细采集记录时出错！'.$title.$url);
                }
            }


            $msg.=$title.$url.'<Br>';
        }


        return $this->reinfo($msg,'get_detail',[$id,$istest]);

    }

    /**
     * 重写系统的跳转以提示
     */
    function reinfo($msg,$path, $parms = [])
    {
        $this->assign('msg',$msg);
        $this->assign('url',url($path,$parms));
        return $this->fetch('reinfo');//parent::redirect($path, $parms); // TODO: Change the autogenerated stub
    }

    function log($id,$log){
        db()->insert('grabs_log',['grabs_id'=>$id,'users_id'=>request($this->session_id_str),'log'=>$log,'create_time'=>time()]);
    }

    function getNeedBetween($kw1,$mark1,$mark2)
    {
        $kw = $kw1;
        $st = stripos($kw, $mark1);
        $ed = stripos($kw, $mark2);
        if (($st == false || $ed == false) /*|| $st >= $ed*/)
            return 0;
        $kw = substr($kw, ($st + strlen($mark1)), ($ed - $st - strlen($mark1)));
        return $kw;
    }


}