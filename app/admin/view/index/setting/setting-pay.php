<div class="tab-pane fade" id="pills-pay-icon" role="tabpanel" aria-labelledby="pills-pay-tab-icon">



    <div class="row">
        <div class="col-lg-6">



            <ul class="nav nav-tabs nav-secondary" id="pills-tab" role="tablist5">
                <li class="nav-item submenu">
                    <a class="nav-link active show" id="pills-alipay-tab" data-toggle="pill"
                       href="#pills-alipay" role="tab" aria-controls="pills-alipay" aria-selected="false">支付宝</a>
                </li>
                <li class="nav-item submenu">
                    <a class="nav-link" id="pills-wxpay-tab" data-toggle="pill" href="#pills-wxpay" role="tab"
                       aria-controls="pills-wxpay" aria-selected="true">微信</a>
                </li>

            </ul>

            <div class="tab-content mt-2 mb-3 row" id="pills-tabContent">
                <div class="tab-pane fade show active col-md-12" id="pills-alipay" role="tablist5"
                     aria-labelledby="pills-alipay-tab">

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">支付宝账号</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_ali_account" type="text" placeholder="" value="<?=$m['pay_ali_account']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">支付宝APPID</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_ali_appid" type="text" placeholder="" value="<?=$m['pay_ali_appid']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">商户私钥</label>
                        <div class="col-md-9 p-0">
                            <textarea class="form-control input-full" name="pay_ali_private_key"><?=$m['pay_ali_private_key']?></textarea>
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">支付宝公钥</label>
                        <div class="col-md-9 p-0">
                            <textarea class="form-control input-full" name="pay_ali_public_key"><?=$m['pay_ali_public_key']?></textarea>
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade col-md-12" id="pills-wxpay" role="tablist5"
                     aria-labelledby="pills-wxpay-tab">

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">公众号APPID</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_wx_appid" type="text" placeholder="" value="<?=$m['pay_wx_appid']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">公众号APPSECRT</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_wx_appsecrt" type="text" placeholder="" value="<?=$m['pay_wx_appsecrt']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">公众号TOKEN</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_wx_token" type="text" placeholder="" value="<?=$m['pay_wx_token']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">公众号Encodingaeskey</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_wx_encodingaeskey" type="text" placeholder="" value="<?=$m['pay_wx_encodingaeskey']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">商户ID</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_wx_mchid" type="text" placeholder="" value="<?=$m['pay_wx_mchid']?>">
                        </div>
                    </div>


                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">商户密钥</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_wx_key" type="text" placeholder="" value="<?=$m['pay_wx_key']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">证书apiclient_cert</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_wx_apiclient_cert" type="text" placeholder="" value="<?=$m['pay_wx_apiclient_cert']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">证书apiclient_key</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="pay_wx_apiclient_key" type="text" placeholder="" value="<?=$m['pay_wx_apiclient_key']?>">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>