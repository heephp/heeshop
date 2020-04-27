<div class="tab-pane fade" id="pills-watermark-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
    <p>

    <div class="row">
        <div class="col-lg-6">


            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">是否开启水印</label>
                <div class="col-md-9 p-0">
                    <select class="form-control input-full" name="watermark">
                        <option value="0" <?=$m['watermark']==='0'?'selected':''?>>否</option>
                        <option value="1" <?=$m['watermark']==='1'?'selected':''?>>是</option>
                    </select>
                </div>
            </div>


            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">水印文字</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="watermark_txt" type="text" placeholder="" value="<?=$m['watermark_txt']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">文字大小</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="watermark_fontsize" type="text" placeholder="" value="<?=$m['watermark_fontsize']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">字体文件</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="watermark_font" type="text" placeholder="" value="<?=$m['watermark_font']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">水印图片</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="watermark_img" type="text" placeholder="" value="<?=$m['watermark_img']?>">
                    <small>优先使用图片水印</small>
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">水印位置</label>
                <div class="col-md-9 p-0">
                    <table class="table">
                        <tr>
                            <td><input type="radio" value="1" name="watermark_postion" <?=$m['watermark_postion']==1?'checked':''?>> 左上</td>
                            <td><input type="radio" value="2" name="watermark_postion" <?=$m['watermark_postion']==2?'checked':''?>> 上中</td>
                            <td><input type="radio" value="3" name="watermark_postion" <?=$m['watermark_postion']==3?'checked':''?>> 右上</td>
                        </tr>
                        <tr>
                            <td><input type="radio" value="4" name="watermark_postion" <?=$m['watermark_postion']==4?'checked':''?>> 左中</td>
                            <td><input type="radio" value="5" name="watermark_postion" <?=$m['watermark_postion']==5?'checked':''?>> 居中</td>
                            <td><input type="radio" value="6" name="watermark_postion" <?=$m['watermark_postion']==6?'checked':''?>> 中右</td>
                        </tr>
                        <tr>
                            <td><input type="radio" value="7" name="watermark_postion" <?=$m['watermark_postion']==7?'checked':''?>> 左下</td>
                            <td><input type="radio" value="8" name="watermark_postion" <?=$m['watermark_postion']==8?'checked':''?>> 中下</td>
                            <td><input type="radio" value="9" name="watermark_postion" <?=$m['watermark_postion']==9?'checked':''?>> 右下</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>



    </p>
</div>