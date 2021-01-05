<div class="tab-pane fade" id="pills-website-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
    <p>

    <div class="row">
        <div class="col-lg-6">

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">网站名称</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="website_name" type="text" placeholder="" value="<?=$m['website_name']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">网站网址</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="website_url" type="text" placeholder="" value="<?=$m['website_url']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">网站Logo</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="website_logo" type="text" placeholder="" value="<?=$m['website_logo']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">网站关键词</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="website_keyword" type="text" placeholder="" value="<?=$m['website_keyword']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">网站描述</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="website_description" type="text" placeholder="" value="<?=$m['website_description']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">网站统计</label>
                <div class="col-md-9 p-0">
                    <textarea type="text" class="form-control input-full" name="website_description" placeholder="统计代码" ><?=$m['website_description']?></textarea>
                </div>
            </div>
            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">过滤文本</label>
                <div class="col-md-9 p-0">
                    <textarea type="text" class="form-control input-full" name="filtertxt" placeholder="替换文本" ><?=$m['filtertxt']?></textarea><br>
                    使用|分隔
                </div>
            </div>
            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">替换为文本</label>
                <div class="col-md-1 p-0">
                    <input class="form-control input-full" name="replacetxt" type="text" placeholder="" value="<?=$m['replacetxt']?>">
                </div>
            </div>
            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">支付成功后订单状态</label>
                <div class="col-md-3 p-0">
                    <select class="form-control" name="order_paysucc_state">
                        <option value="1" <?=$m['order_paysucc_state']=='1'?'selected':''?>><?=get_order_state(1)?></option>
                        <option value="2" <?=$m['order_paysucc_state']=='2'?'selected':''?>><?=get_order_state(2)?></option>
                        <option value="3" <?=$m['order_paysucc_state']=='3'?'selected':''?>><?=get_order_state(3)?></option>
                        <option value="4" <?=$m['order_paysucc_state']=='4'?'selected':''?>><?=get_order_state(4)?></option>
                    </select>
                </div>
            </div>
            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">支付成功后生效时长</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="pay_succ_endtime" type="text" placeholder="" value="<?=$m['pay_succ_endtime']?>">（小时）
                    实物商品无需设置，服务商品需要设置
                </div>
            </div>
        </div>
    </div>


    </p>
</div>