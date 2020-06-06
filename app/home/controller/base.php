<?php
namespace app\home\controller;
use heephp\controller;
use heephp\logger;

class base extends controller
{
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
            $this->assign($l['tag'],$l['links']);
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
        $mo =model('shop_order');
        $mo->get($orderid);
        $m=$mo->data;
        $money = $m['sumprice'];
        //创建支付流水
        $spay=model('shop_pay');
        $date = new \DateTime();
        $pay_id=$date->format('ymdHisu').randChar(6,'number');
        $d['shop_pay_id']=$pay_id;
        $d['shop_order_id']=$orderid;
        $d['money']=$money;
        $d['state']=0;
        $spay->insert($d);
        $m=$spay->get($pay_id);
        if(!$m){
            return $this->error('创建支付流水失败！');
            exit;
        }
        $re['desc']='订单号：'.$orderid;
        $re['pay_id']=$pay_id;
        $re['money']=$money;
        return $re;
    }

    /**
     * 收到订单反馈后处理
     * @param $out_trade_on
     * @param $money
     */
    protected function _order_do_action($data,$out_trade_on,$type='微信', $money=-999)
    {
        //流水号金额对比 取订单信息 更新状态
        $spay = model('shop_pay');
        $m = $spay->where("`shop_pay_id`='$out_trade_on'")->find();
        //支付金额对比
        if ($money == $m['money']||$money==-999) {
            $m['sate'] = 1;
            $m['paytype']=$type;
            $m['money']=$money;
            $m['restr']=json_encode($data);
            $result = $spay->update($m);
            if (!$result) {
                logger::info("订单号$out_trade_on 支付成功，但更新流水号状态失败！");
            }
            //更新订单状态
            $mo = model('shop_order');
            $morder = $mo->where("shop_order_id='" . $m['shop_order_id'] . "'")->find();
            $morder['state'] = 1;
            $re2 = $spay->update($m);
            if (!$re2) {
                logger::info("订单号$out_trade_on 支付成功，但更新订单状态失败！");
            }
        } else {
            logger::info("订单号$out_trade_on 支付成功，但金额不匹配：实际支付：$money 应支付：" . $m['money']);
        }
    }
}