<div class="tab-pane fade" id="pills-vcode-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
    <p>


    <div class="row">
        <div class="col-lg-6">


            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">是否开启验证码</label>
                <div class="col-md-9 p-0">
                    <select class="form-control input-full" name="is_vcode">
                        <option value="0" <?=$m['is_vcode']==='0'?'selected':''?>>否</option>
                        <option value="1" <?=$m['is_vcode']==='1'?'selected':''?>>是</option>
                    </select>
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">验证码字符</label>
                <div class="col-md-9 p-0">
                    <select class="form-control input-full" name="vcode_char">
                        <option value="all" <?=$m['vcode_char']=='all'?'selected':''?>>大小写字母数字</option>
                        <option value="char" <?=$m['vcode_char']=='char'?'selected':''?>>大小写字母</option>
                        <option value="upper" <?=$m['vcode_char']=='upper'?'selected':''?>>大写字母</option>
                        <option value="lower" <?=$m['vcode_char']=='lower'?'selected':''?>>小写字母</option>
                        <option value="number" <?=$m['vcode_char']=='number'?'selected':''?>>数字</option>
                    </select>
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">验证码位数</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="vcode_num" type="number" placeholder="" value="<?=$m['vcode_num']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">验证码宽度</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="vcode_width" type="number" placeholder="" value="<?=$m['vcode_width']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">验证码高度</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="vcode_heigh" type="number" placeholder="" value="<?=$m['vcode_heigh']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">验证码干扰线量</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="vcode_line_count" type="number" max="20" min="0" placeholder="" value="<?=$m['vcode_line_count']?>">
                </div>
            </div>

        </div>
    </div>

    </p>
</div>