<?php
namespace app\home\controller;
use heephp\controller;
use heephp\logger;

class base extends controller
{
    protected $session_id_str='session.user_id';
    protected $session_name_str='session.user_name';
    protected $session_users_group_id_str='session.user_group_id';
    protected $session_users_group_name_str='session.user_group_name';
    protected $session_users_header_str='session.user_header';
    protected $session_users_email_str='session.user_email';
    protected $session_users_num_str='session.user_login_num';
    protected $userid;

    public function __construct()
    {
        parent::__construct();

        //读取配置
        $config=model('config');
        $webconfig = $config->getall();
        $this->assign('c',$webconfig);

        //读取菜单
        $lg = model("link_group");
        $lg->select();
        $lg->links();


        foreach ($lg->data as $l){
            $l['links'] = array_filter($l['links'],function($item){
                return empty($item['parent_id']);
            });
            $this->assign($l['tag'],$l['links']);
        }

        if(CONTROLLER!='user'){
            if($this->cklogin()){
                $this->userid = request($this->session_id_str);
            }
        }

    }

    /**
     * 获取订单信息 并 生成支付信息
     * @param $orderid
     * @return false|string
     * @throws \Exception
     */
    protected function _order_do_pay($orderid){
        //获取订单信息
        $mo =model('order');
        $mo->get($orderid);
        $m=$mo->data;
        $money = $m['sumprice'];
        //创建支付流水
        $spay=model('order_pay');
        $date = new \DateTime();
        $pay_id=$date->format('ymdHisu').randChar(6,'number');
        $d['order_pay_id']=$pay_id;
        $d['order_id']=$orderid;
        $d['money']=$money;
        $d['state']=0;
        $d['create_users_id']=empty(request($this->session_id_str))?request('session.admin_user_id'):request($this->session_id_str);
        $d['create_time']=time();
        $spay->insert($d);
        $m=$spay->get($pay_id);
        if(!$m){
            return $this->error('创建支付流水失败！');
            exit;
        }
        //取产品名称
        $mo->detail();
        $products = $mo->data['detail'][0]['product'];//var_dump($mo->data['detail'][0]['product']);exit;
        $re['desc']= (array_key_exists('title',$products)?$products['title']:$products['name']).'等产品';
        $re['pay_id']=$pay_id;
        $re['money']=$money;
        return $re;
    }

    /**
     * 收到订单反馈后处理
     * @param $out_trade_on
     * @param $money
     */
    protected function _order_do_action($data,$out_trade_on,$type='微信', $money=-1,$paytime=0)
    {
        //读取默认配置成功状态和服务时间
        $succstate = conf('order_paysucc_state')??1;
        $etime = conf('pay_succ_endtime')*60*60;
        //支付成功时间和开始结束服务时间
        $paytime = empty($paytime)?time():$paytime;
        $stime = $paytime;
        $etime = $stime+$etime;

        //流水号金额对比 取订单信息 更新状态
        $spay = model('order_pay');
        $m = $spay->where("`order_pay_id`='$out_trade_on'")->find();
        if(!$m){
            logger::debug('找不到流水号：'.$out_trade_on.'的记录！');
            return;
        }

        $orderid = $m['order_id'];
        //支付金额对比
        if ($money == $m['money']/*||$money==-1*/) {
            $m['state'] = $succstate;
            $m['paytype']=$type;
            $m['money']=$money;
            $m['restr']=json($data);
            $result = $spay->update($m);
            if (!$result) {
                logger::debug("订单号$orderid 支付成功 流水号 $out_trade_on 状态更新失败！");
            }
            //更新订单状态

            $mo = model('order');
            $morder = $mo->where("order_id='$orderid'")->find();
            $morder['state'] =$succstate;
            $morder['paytype']=$type;
            $morder['paysum']=$money;
            $morder['paytime']=$paytime;
            //$morder['stime'] = time();
            //$morder['etime'] = time()+conf('pay_succ_endtime');
            $re2 = $mo->update($morder);
            if (!$re2) {
                logger::debug("订单号$orderid 支付成功，但更新订单状态失败！");
            }

            //更新订单详细
            $md = model('order_detail');
            $mdda = $md->where("order_id='$orderid'")->find();
            $mdda['state']=$succstate;
            $mdda['stime']=$stime;
            $mdda['etime']=$etime;
            $st = $md->where("order_id='$orderid'")->update($mdda);
            if(!$st){
                logger::debug("订单号$orderid 支付成功，但更订单详细更新失败！");
            }

        } else {
            logger::debug("订单号$orderid 支付成功，但金额不匹配：实际支付：$money 应支付：" . $m['money']);
        }
    }

    protected function cklogin()
    {
        //如果登录
        if(!empty(request($this->session_id_str))&&!empty(request($this->session_name_str))){
            $this->assign('user_id',request($this->session_id_str));
            $this->assign('user_name',request($this->session_name_str));
            $this->assign('usergroup',request($this->session_users_group_name_str));
            $this->assign('usergroup_id',request($this->session_users_group_id_str));
            $this->assign('user_header',request($this->session_users_header_str));
            $this->assign('user_email',request($this->session_users_email_str));
            $this->assign('user_loginnum',request($this->session_users_num_str));
            $this->assign('islogin',true);
            $noread = model('message')->where("isread=0 and receiver_users_id=".request($this->session_id_str))->count()->value();
            $this->assign('noread',$noread);
            return true;
        }
        $this->assign('islogin',false);
        return false;
    }
}