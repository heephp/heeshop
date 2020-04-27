<div class="tab-pane fade" id="pills-upload-icon" role="tabpanel" aria-labelledby="pills-home-tab-icon">
    <p>


    <div class="row">
        <div class="col-lg-6">

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">上传目录</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="upload_dir" type="text" placeholder="" value="<?=$m['upload_dir']?>">
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">文件大小</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="upload_size" type="text" placeholder="" value="<?=$m['upload_size']?>">
                    <small>单位:k</small>
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">文件格式</label>
                <div class="col-md-9 p-0">
                    <input class="form-control input-full" name="upload_ext" type="text" placeholder="" value="<?=$m['upload_ext']?>">
                    <small>示例：*.jpg,*.png,*.gif</small>
                </div>
            </div>

            <div class="form-group form-inline">
                <label class="col-md-3 col-form-label" for="inlineinput">文件名规则</label>
                <div class="col-md-9 p-0">
                    <select class="form-control input-full" name="upload_file_name"  value="<?=$m['upload_file_name']?>">
                        <option value="md5" <?=$m['upload_file_name']=='md5'?'selected':''?>>md5</option>
                        <option value="timespan" <?=$m['upload_file_name']=='timespan'?'selected':''?>>timespan</option>
                        <option value="guid" <?=$m['upload_file_name']=='guid'?'selected':''?>>guid</option>
                    </select>
                </div>
            </div>


        </div>
    </div>


    </p>
</div>