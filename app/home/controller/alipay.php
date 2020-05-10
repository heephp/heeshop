<?php
namespace app\home\controller;
use heephp\bulider\form;
use heephp\bulider\table;
use  heephp\controller;
use heephp\formbulider;
use heephp\logger;
use heephp\route;

class alipay extends controller
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
            'notify_url' => 'http://pay.thinkadmin.top/test/alipay-notify.php',
            // 网页支付回跳地址
            'return_url' => 'http://pay.thinkadmin.top/test/alipay-notify.php',
        ];
    }

    public function pay($orderid){
        $config=$this->config();

        try {
            // 实例支付对象
            $pay = \AliPay\Web::instance($config);

            // 参考链接：https://docs.open.alipay.com/api_1/alipay.trade.page.pay
            $result = $pay->apply([
                'out_trade_no' => time(), // 商户订单号
                'total_amount' => '1', // 支付金额
                'subject'      => '支付订单描述', // 支付订单描述
            ]);

            echo $result;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function msg($msg){

    }

    public function notify(){

        try {
            $config=$this->config();
            $pay = \AliPay\App::instance($config);

            $data = $pay->notify();
            if (in_array($data['trade_status'], ['TRADE_SUCCESS', 'TRADE_FINISHED'])) {
                // @todo 更新订单状态，支付完成
                logger::info("收到来自支付宝的异步通知\r\n");
                logger::info( '订单号：' . $data['out_trade_no'] );
                logger::info('订单金额：' . $data['total_amount'] );
            } else {
                logger::info( "收到异步通知\r\n");
            }
        } catch (\Exception $e) {
            // 异常处理
            echo $e->getMessage();
        }
    }

}