<?php
namespace app\admin\controller;

class message extends adminBase{


    public function manager($users_id=0,$receiver_users_id=0){
        $mes = model('message');

        $wsql='';
        if($users_id>0&&$receiver_users_id>0){
            $wsql = "`users_id`=$users_id and `receiver_users_id`=$receiver_users_id";
        }else if ($users_id>0&&$receiver_users_id==0){
            $wsql = "`users_id`=$users_id";
        }else if ($users_id==0&&$receiver_users_id>0){
            $wsql = "`receiver_users_id`=$receiver_users_id";
        }

        $mes->page($wsql);
        $mes->sender();
        $mes->receiver();//var_dump($mes->data);
        $this->assign('list',$mes->data);
        $this->assign('pager',$mes->pager['show']);
        return $this->fetch();
    }

    function add(){
        return $this->fetch('edit');
    }

    public function edit($id){
        $mes = model('message');
        $mes->get($id);
        $mes->receiver();
        $this->assign('m',$mes->data);
        return $this->fetch();
    }

    public function detail($id){
        $mes = model('message');
        $m=$mes->get($id);
        $mes->receiver();
        $mes->sender();

        //如果是登录人接收的消息 并没有标记已读的 标记为已读
        if($m['receiver_users_id']==request($this->session_id_str)&&$m['isread']==0){
            $m['isread']=1;
            $mes->update($m);
        }

        $this->assign('m',$mes->data);
        return $this->fetch();
    }

    /**
     * 标记所有为已读
     */
    public function markallread(){
        $db = db();
        $result = $db->update('message',['isread'=>1],"`receiver_users_id`='".request($this->session_id_str)."'");
        return $this->json(['state'=>'ok','msg'=>$result]);
    }


    function delete($id){
        $mes = model('message');
        $re = $mes->delete($id);
        if($re){
            return $this->success('删除成功！',url('manager'));
        }else
            return $this->error('删除失败');
    }

    public function save(){
        $data=request('post.');
        $data['users_id']=request($this->session_id_str);
        $passusers='';//没有发送成功的用户

        $mes = model('message');
        if(!empty($data['message_id'])){
            unset($data['receiver']);
            $result = $mes->update($data);
        }else{

            $data['isread']=0;
            $receiver = $data['receiver'];
            unset($data['receiver']);
            if(trim($receiver)=='all') {

                $data['`all`'] = 1;
                $result = $mes->insert($data);

            }else {
                $users = model('users');

                $data['`all`'] = 0;
                $rs = explode(',',$receiver);
                foreach ($rs as $r){
                    $ruid = $users->getByusers_id("`username`='$r'");

                    //如果是自己则不发送
                    if($ruid==$data['users_id']||empty($ruid)){
                        $passusers.=$r.',';
                        continue;
                    }
                    //发送
                    if(!empty($ruid)) {
                        $data['receiver_users_id'] = $ruid;
                        $result = $mes->insert($data);
                        //如果发送失败则记录
                        if(!$result)
                            $passusers.=$r.',';
                    }
                }

            }

        }
        if($result){
            return $this->success('保存成功！'.(empty($passusers)?'':('没有发送的用户：'.$passusers)),url('manager'));
        }else
            return $this->error('保存失败！'.(empty($passusers)?'':('没有发送的用户：'.$passusers)));
    }


}