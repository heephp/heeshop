<div class="tab-pane fade" id="pills-sms-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
    <p>


    <div class="row">
        <div class="col-lg-6">

            <ul class="nav nav-tabs nav-secondary" id="pills-tab" role="tablist2">
                <li class="nav-item submenu">
                    <a class="nav-link active show" id="pills-home-tab" data-toggle="pill"
                       href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">阿里短信</a>
                </li>
                <li class="nav-item submenu">
                    <a class="nav-link" id="pills-wy-tab" data-toggle="pill" href="#pills-wy" role="tab"
                       aria-controls="pills-wy" aria-selected="true">网易云信</a>
                </li>

            </ul>

            <div class="tab-content mt-2 mb-3 row" id="pills-tabContent">
                <div class="tab-pane fade show active col-md-12" id="pills-home" role="tablist2"
                     aria-labelledby="pills-home-tab">

                        <div class="form-group form-inline">
                            <label class="col-md-3 col-form-label" for="inlineinput">短信AccessKeyId</label>
                            <div class="col-md-9 p-0">
                                <input class="form-control input-full" name="sms_accessKeyId" type="text" placeholder="" value="<?=$m['sms_accessKeyId']?>">
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label class="col-md-3 col-form-label" for="inlineinput">短信accessKeySecret</label>
                            <div class="col-md-9 p-0">
                                <input class="form-control input-full" name="sms_accessKeySecret" type="text" placeholder="" value="<?=$m['sms_accessKeySecret']?>">
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label class="col-md-3 col-form-label" for="inlineinput">短信签名</label>
                            <div class="col-md-9 p-0">
                                <input class="form-control input-full" name="sms_SingName" type="text" placeholder="" value="<?=$m['sms_SingName']?>">
                                <small>短信签名多个用半角逗号分隔</small>
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label class="col-md-3 col-form-label" for="inlineinput">短信模板</label>
                            <div class="col-md-9 p-0">
                                <input class="form-control input-full" name="sms_TemplateCode" type="text" placeholder="" value="<?=$m['sms_TemplateCode']?>">
                                <small>短信模板多个用半个逗号分隔</small>
                            </div>
                        </div>
                </div>

                <div class="tab-pane fade col-md-12" id="pills-wy" role="tablist2"
                     aria-labelledby="pills-wy-tab">

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">短信AccessKeyId</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="sms_accessKeyId" type="text" placeholder="" value="<?=$m['sms_accessKeyId']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">短信accessKeySecret</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="sms_accessKeySecret" type="text" placeholder="" value="<?=$m['sms_accessKeySecret']?>">
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">短信签名</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="sms_SingName" type="text" placeholder="" value="<?=$m['sms_SingName']?>">
                            <small>短信签名多个用半角逗号分隔</small>
                        </div>
                    </div>

                    <div class="form-group form-inline">
                        <label class="col-md-3 col-form-label" for="inlineinput">短信模板</label>
                        <div class="col-md-9 p-0">
                            <input class="form-control input-full" name="sms_TemplateCode" type="text" placeholder="" value="<?=$m['sms_TemplateCode']?>">
                            <small>短信模板多个用半个逗号分隔</small>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>


    </p>
</div>