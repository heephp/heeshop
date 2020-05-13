<?php
namespace app\home\controller;
use heephp\bulider\form;
use heephp\bulider\table;
use  heephp\controller;
use heephp\formbulider;
use heephp\route;

class wxpay extends base
{

    private function config()
    {

        return [
            'token' => conf('pay_wx_token'),
            'appid' => conf('pay_wx_appid'),
            'appsecret' => conf('pay_wx_appsecrt'),
            'encodingaeskey' => conf('pay_wx_encodingaeskey'),
            // 配置商户支付参数
            'mch_id' => conf('pay_wx_mchid'),
            'mch_key' => conf('pay_wx_key'),
            // 配置商户支付双向证书目录 （p12 | key,cert 二选一，两者都配置时p12优先）
            'ssl_p12' => '',
            // 'ssl_key'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_key.pem',
            // 'ssl_cer'        => __DIR__ . DIRECTORY_SEPARATOR . 'cert' . DIRECTORY_SEPARATOR . '1332187001_20181030_cert.pem',
            // 配置缓存目录，需要拥有写权限
            'cache_path' => '',
        ];
    }

    public function pay($orderid)
    {
        $config = $this->config();
        try {

            $wechat = \WeChat\Pay::instance($config);

            $re = $this->_order_do_pay($orderid);

            // 4. 组装参数，可以参考官方商户文档
            $options = [
                'body' => $re['desc'],
                'out_trade_no' => $re['pay_id'],
                'total_fee' => $re['money']*100,
                //'openid' => 'oQRNGt4yLABG34Q_NXV3RFQblAaU',
                'trade_type' => 'NATIVE',//JSAPI  NATIVE
                'notify_url' => 'http://a.com/text.html',
                'spbill_create_ip' => '127.0.0.1',
            ];
            // 生成预支付码
            $result = $wechat->createOrder($options);
            // 创建JSAPI参数签名
            $options = $wechat->createParamsForJsApi($result['prepay_id']);

            $this->scerweima2($result['code_url']);
            //echo '<pre>';
            //echo "\n--- 创建预支付码 ---\n";
            //var_export($result);

            //echo "\n\n--- JSAPI 及 H5 参数 ---\n";
            //var_export($options);

        } catch (Exception $e) {

            // 出错啦，处理下吧
            echo $e->getMessage() . PHP_EOL;


        }
    }

    function scerweima2($url=''){
        $value = $url;         //二维码内容
        $errorCorrectionLevel = 'L';  //容错级别
        $matrixPointSize = 5;      //生成图片大小
        //生成二维码图片
        require_once './../plugin/phpqrcode/phpqrcode.php';
        $QR = \QRcode::png($value,false,$errorCorrectionLevel, $matrixPointSize, 2);
    }

    public function jssdk_sign()
    {

        try {

            // 2. 准备公众号配置参数
            $config = $this->config();

            // 3. 创建接口实例
            $wechat = \WeChat\Script::instance($config);

            // 4. 获取JSSDK网址签名配置
            $result = $wechat->getJsSign('http://a.com/test.php');

            var_export($result);

        } catch (Exception $e) {

            // 出错啦，处理下吧
            echo $e->getMessage() . PHP_EOL;

        }
    }

    public function notify(){

        try {

            $config = $this->config();

            // 3. 创建接口实例
            $wechat = \WeChat\Pay::instance($config);

            // 4. 获取通知参数
            $data = $wechat->getNotify();
            if ($data['return_code'] === 'SUCCESS' && $data['result_code'] === 'SUCCESS') {
                // @todo 去更新下原订单的支付状态
                $order_no = $data['out_trade_no'];
                parent::_order_do_action($data,$order_no);
                // 返回接收成功的回复
                ob_clean();
                echo $wechat->getNotifySuccessReply();
            }

        } catch (Exception $e) {

            // 出错啦，处理下吧
            echo $e->getMessage() . PHP_EOL;

        }
    }

}