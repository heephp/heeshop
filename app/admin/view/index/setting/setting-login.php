<div class="tab-pane fade" id="pills-login-icon" role="tabpanel" aria-labelledby="pills-login-tab-icon">



    <div class="row">
        <div class="col-lg-6">



            <ul class="nav nav-tabs nav-secondary" id="pills-tab" role="tablist2">
                <li class="nav-item submenu">
                    <a class="nav-link active show" id="pills-home-tab" data-toggle="pill"
                       href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">QQ</a>
                </li>
                <li class="nav-item submenu">
                    <a class="nav-link" id="pills-wx-tab" data-toggle="pill" href="#pills-wx" role="tab"
                       aria-controls="pills-wx" aria-selected="true">微信</a>
                </li>
                <li class="nav-item submenu">
                    <a class="nav-link" id="pills-wb-tab" data-toggle="pill" href="#pills-wb" role="tab"
                       aria-controls="pills-wb" aria-selected="true">微博</a>
                </li>
                <li class="nav-item submenu">
                    <a class="nav-link" id="pills-bd-tab" data-toggle="pill" href="#pills-bd" role="tab"
                       aria-controls="pills-bd" aria-selected="true">百度</a>
                </li>
                <li class="nav-item submenu">
                    <a class="nav-link" id="pills-ali-tab" data-toggle="pill" href="#pills-ali" role="tab"
                       aria-controls="pills-ali" aria-selected="true">支付宝</a>
                </li>

            </ul>

            <div class="tab-content mt-2 mb-3 row" id="pills-tabContent">
                <div class="tab-pane fade show active col-md-12" id="pills-home" role="tablist2"
                     aria-labelledby="pills-home-tab">

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">APPID</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_qq_appid" type="text" placeholder="" value="<?=$m['login_qq_appid']?>">
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">APPKEY</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_qq_appkey" type="text" placeholder="" value="<?=$m['login_qq_appkey']?>">
                        </div>
                    </div>
                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">回调地址</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_qq_callback" type="text" placeholder="" value="<?=$m['login_qq_callback']?>">
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade col-md-12" id="pills-wx" role="tablist2"
                     aria-labelledby="pills-wx-tab">

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">APPID</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_wx_appid" type="text" placeholder="" value="<?=$m['login_wx_appid']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">APPSECRT</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_wx_appsecrt" type="text" placeholder="" value="<?=$m['login_wx_appsecrt']?>">
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade col-md-12" id="pills-wb" role="tablist2"
                     aria-labelledby="pills-wb-tab">

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">APP KEY</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_wb_appkey" type="text" placeholder="" value="<?=$m['login_wb_appkey']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">APP SECRT</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_wb_appsecrt" type="text" placeholder="" value="<?=$m['login_wb_appsecrt']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">网站域名</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_bd_domain" type="text" placeholder="" value="<?=$m['login_bd_domain']?>">
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade col-md-12" id="pills-bd" role="tablist2"
                     aria-labelledby="pills-bd-tab">

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">API Key</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_bd_appid" type="text" placeholder="" value="<?=$m['login_bd_appid']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">Secret Key</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_bd_appsecrt" type="text" placeholder="" value="<?=$m['login_bd_appsecrt']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">回调地址</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_bd_callback" type="text" placeholder="" value="<?=$m['login_bd_callback']?>">
                        </div>
                    </div>

                </div>

                <div class="tab-pane fade col-md-12" id="pills-ali" role="tablist2"
                     aria-labelledby="pills-ali-tab">

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">APPID</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="login_ali_appid" type="text" placeholder="" value="<?=$m['login_ali_appid']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">开发者私钥</label>
                        <div class="col-md-9 p-0">
                            <textarea class="form-control input-full" name="login_ali_private_key">
                                <?=$m['login_ali_private_key']?>
                            </textarea>
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">支付宝公钥</label>
                        <div class="col-md-9 p-0">
                            <textarea class="form-control input-full" name="login_ali_public_key">
                                <?=$m['login_ali_public_key']?>
                            </textarea>
                        </div>
                    </div>

                </div>
            </div>


        </div>
    </div>
</div>