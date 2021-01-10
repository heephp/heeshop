<?php
namespace app\home\controller;
use app\admin\controller\model;
use heephp\bulider\form;
use heephp\bulider\pager;
use heephp\bulider\table;
use  heephp\controller;
use heephp\formbulider;
use heephp\logger;
use heephp\route;

class alipay extends base
{
    private function config()
    {
        return [
            // 沙箱模式
            'debug' => false,
            // 签名类型（RSA|RSA2）
            'sign_type' => "RSA2",
            // 应用ID
            'appid' => conf('pay_ali_appid'),
            // 支付宝公钥 (1行填写，特别注意，这里是支付宝公钥，不是应用公钥，最好从开发者中心的网页上去复制)
            'public_key' => conf('pay_ali_public_key'),
            // 支付宝私钥 (1行填写)
            'private_key' => conf('pay_ali_private_key'),
            // 应用公钥证书（新版资金类接口转 app_cert_sn）
            'app_cert' => '',
            // 支付宝根证书（新版资金类接口转 alipay_root_cert_sn）
            'root_cert' => '',
            // 支付成功通知地址
            'notify_url' => conf('website_url').'/home/alipay/notify',
            // 网页支付回跳地址
            'return_url' => conf('website_url').'/home/alipay/paysuccess',
        ];
    }

    public function pay($orderid){

        $config=$this->config();

        try {
            // 实例支付对象
            $pay = \AliPay\Web::instance($config);

            $re = $this->_order_do_pay($orderid);

            // 参考链接：https://docs.open.alipay.com/api_1/alipay.trade.page.pay
            $result = $pay->apply([
                'out_trade_no' => $re['pay_id'], // 商户订单号
                'total_amount' => $re['money'], // 支付金额
                'subject'      => $re['desc'], // 支付订单描述
            ]);

            echo $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function notify(){
        logger::debug('支付宝来过');
        try {
            $config=$this->config();
            $pay = \AliPay\App::instance($config);

            $data = $pay->notify();
            if (in_array($data['trade_status'], ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
                $out_trade_on = $data['out_trade_no'];
                $money=$data['total_amount'];
                // @todo 更新订单状态，支付完成
                logger::debug("收到来自支付宝的异步通知\r\n");
                logger::debug( '订单号：' . $data['out_trade_no'] );
                logger::debug('订单金额：' . $data['total_amount'] );

                parent::_order_do_action($data,$out_trade_on,'支付宝',$money);

            } else {

                logger::debug( "收到异步通知\r\n");
            }
            return 'success';
        } catch (\Exception $e) {
            // 异常处理
            logger::debug('支付宝'.$e->getMessage());

            echo $e->getMessage();
        }
    }

    public function paysuccess()
    {

        try {
            $config = $this->config();
            $pay = \AliPay\App::instance($config);

            $data = $pay->query(request('get.out_trade_no'));
            if (in_array($data['trade_status'], ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {

                $out_trade_on = $data['out_trade_no'];
                $money = $data['total_amount'];
                $pay_time =  strtotime($data['send_pay_date']);
                // @todo 更新订单状态，支付完成
                //var_dump($pay_time);
//var_dump($data);
                parent::_order_do_action($data, $out_trade_on, '支付宝', $money,$pay_time);

                echo '<h2><font color="red"> 支付宝支付成功！<br></font>';
                echo '订单号：' . $data['out_trade_no'].'<br>';
                echo '订单金额：' . $data['total_amount'].'</h2><br>';
                echo '<a href="'.url('user/orders').'">跳转到用户中心</a>';

            }

        } catch (\Exception $e) {
            // 异常处理
            echo $e->getMessage();
        }

    }

}