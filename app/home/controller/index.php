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

        $config = [
            // 沙箱模式
            'debug'       => false,
            // 应用ID
            'appid'       => '2018011901968294',
            // 支付宝公钥(1行填写)
            'public_key'  => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjIE8pEP9KNTvakTLGia3YmawOcvtQ+MYR4zNzLMaANf0YInIQJWiL2HY+ocPaEJlLo24uIMxVWkB48Xonz/OAdHkQ1+XM9daU8FVcrXyu4JLuhomnxelJNDdrmNMa+iXK9T+lA3xPi9C5pcgvt5Wtfz8EMZWZaPpOc7wC0YDLFCOpS3SpOTtpGfWk7S4tdxIelW2XtjiaDS+AVxROlArShgk/TEdbxP18me4FAQ3eYv/F1uD/f+1fvAeiR2cEU78aVpG3H0uBa7bSSbhmLGTFvnP0hc+i4TUeIXrmnkmIKC9hZictGcvcXZ/LnLFCAaQI8yb1bpbaOsN/23YtIAmGQIDAQAB',
            // 支付宝私钥(1行填写)
            'private_key' => 'MIIEowIBAAKCAQEAjIE8pEP9KNTvakTLGia3YmawOcvtQ+MYR4zNzLMaANf0YInIQJWiL2HY+ocPaEJlLo24uIMxVWkB48Xonz/OAdHkQ1+XM9daU8FVcrXyu4JLuhomnxelJNDdrmNMa+iXK9T+lA3xPi9C5pcgvt5Wtfz8EMZWZaPpOc7wC0YDLFCOpS3SpOTtpGfWk7S4tdxIelW2XtjiaDS+AVxROlArShgk/TEdbxP18me4FAQ3eYv/F1uD/f+1fvAeiR2cEU78aVpG3H0uBa7bSSbhmLGTFvnP0hc+i4TUeIXrmnkmIKC9hZictGcvcXZ/LnLFCAaQI8yb1bpbaOsN/23YtIAmGQIDAQABAoIBAQCB4tbUY6WcIXxRmNbIjhHo/VTbmRD1OPIw8pEtMkRPk1NuCvD8A1eyxZl3v3MWxooSxyCEMYNhmXkNvt6UmL8wH4AMaEm2utXdp1P+fwStIn4uxA3/9DPOHOdRVqpG9vUIqBXPeDQTcE1ALWUwDQnLotrCBxfHTgdEUXDGeypjw5Su6h+FIhtR3ULqxQD87+NV+AXyqThH0LXNq6ERStLi/qgYl1hrHJKn1YlFMlAufnV++Es2GkOUkt7+0xu+CRPZuNGlOdFc7QXrGh2DMwBYeh5TNXl5IbcVehwjGQA0w6EU/TvQl+anlgJk5u/ylaVztxEuLq4FqaYhTH1JVIqBAoGBAM5/Eu7em1Z8sBzfw0HQsESMQ/YTF8AjQ7SMP1kxlGqUTMPEJfKa8wT11cA4CRPMN1c092PR1izATI0xf5AAXOYQn+LFUYVmjegMBFULMGEmSDQuzOhf5Q6RqH66QthMW1Vbeo0CHvSqgoNKFWI1MkXtlrq+ynCq8mEAG+z3DSuFAoGBAK4wLwsxiqltLt2JC7+Q9jKfbSQ1yP9yTYB0mZxWBwRt64O9fcJ24BSQXJ7OpaAkH/Aij59ih71ZXicFQt23NWrhG9WlvhIyn6ukCP2JwA5dBrLOGrhpXwDK1gyURBUMIih5fz7LhKzEdzQynbqbXdbmRyqXftuLrAZ/qfQIA4KFAoGAeC3g2QDZq0Y6QTPBsgZA8EQqMYb/JaXge628GK8QT88rtivsYfvoQBTLaGm0br9F3g1HheLUIYtxgiMyuJ5dctBuHU71mQwMvuZvhwdSCth64VPzkbJt30LKq6a/zJ7z8QOimXqIhaDPAJYXR+bp8WTLergbneL/2ZB0sD9AfPkCgYBNHtg1RIH38XdGbl7dOflHAH76ATY0ow7dSMKaDRyeQWx8r3D2oFslv6TCSwvZkyTw1Nxx3NXsZ5zf+dxY/byQzYndVbyJohA/lijE2DBIK7fDgq0h6MU/PI74ksxx5SVadjB4RPNA6ts8KQzcid1KQDpSCTEJUxWe6vb8LHAhYQKBgAu2m0E0afgXoYDDVrl+ltQB8z/4swJBoaZkuVBRKMoMqXTrNgPj72PNr1vMaEEV3sehuGXiXjKJQPavlexhdOdc9eQVG3Zghqly0SKdJiDsITr6QvlLASjvOE2Y/Q9Jj2Kvuus3493OEldxIlDR8zN1+WG0oZiHA0NBg17CZAQJ',
            // 支付成功通知地址
            'notify_url'  => '', // 可以应用的时候配置哦
            // 网页支付回跳地址
            'return_url'  => '', // 可以应用的时候配置哦
        ];

        // 参考公共参数  https://docs.open.alipay.com/203/107090/
        $config['notify_url'] = 'http://www.w3data.top/callback';
        $config['return_url'] = 'http://www.w3data.top/callback';

        try {

            // 实例支付对象
            $pay = \We::AliPayWeb($config);
            // $pay = new \AliPay\Web($config);

            // 参考链接：https://docs.open.alipay.com/api_1/alipay.trade.page.pay
            $result = $pay->apply([
                'out_trade_no' => time(), // 商户订单号
                'total_amount' => '1',    // 支付金额
                'subject'      => '支付订单描述', // 支付订单描述
            ]);

            //echo $result; // 直接输出HTML（提交表单跳转)
            return $this->fetch();

        } catch (Exception $e) {

            // 异常处理
            echo $e->getMessage();

        }

    }

    function wxpay(){
        $config = [
            'token'          => 'test',
            'appid'          => 'wx9d24e93197f03db3',
            'appsecret'      => 'eaef8076232ef6970799d70168187aa7',
            'encodingaeskey' => 'BJIUzE0gqlWy0GxfPp4J1oPTBmOrNDIGPNav1YFH5Z5',
            // 配置商户支付参数（可选，在使用支付功能时需要）
            'mch_id'         => "1338307101",
            'mch_key'        => 'wangyingzhe1986091288wangyingzhe',
            // 配置商户支付双向证书目录（可选，在使用退款|打款|红包时需要）
            'ssl_key'        => '',
            'ssl_cer'        => '',
            // 缓存目录配置（可选，需拥有读写权限）
            'cache_path'     => '',
        ];

        // 创建接口实例
        $wechat = new \WeChat\Pay($config);

        // 组装参数，可以参考官方商户文档
        $options = [
            'body'             => '测试商品',
            'out_trade_no'     => time(),
            'total_fee'        => '1',
            'openid'           => 'o38gpszoJoC9oJYz3UHHf6bEp0Lo',
            'trade_type'       => 'JSAPI',
            'notify_url'       => 'http://a.com/text.html',
            'spbill_create_ip' => '127.0.0.1',
        ];

        try {

            // 生成预支付码
            $result = $wechat->createOrder($options);

            // 创建JSAPI参数签名
            $options = $wechat->createOrder($result['prepay_id']);

            // @todo 把 $options 传到前端用js发起支付就可以了

        } catch (Exception $e) {

            // 出错啦，处理下吧
            echo $e->getMessage() . PHP_EOL;

        }

    }

}