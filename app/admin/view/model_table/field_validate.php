<?import('/layout/header.php');?>
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">数据表</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="#">表验证规则管理</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <span>不填写则不进行验证</span>

                        <form action="<?=url('field_validate_save')?>" method="post">
    <input type="hidden" name="model_id" value="<?=$m['model_table_id']?>">

    <div class="row">
        <div class="col-lg-12">

            <div class="form-group">
                <label for="title">验证规则</label>
                <input type="text" class="form-control" name="validate_rule" placeholder="标题" value="<?=$m['validate_rule']?>">
                <small>验证规则格式：字段|规则1+规则2+规则3=参数1,参数2;字段2|规则1+规则2+规则3=参数;字段3|规则1+....</small>
            </div>

            <div class="form-group">
                <label for="title">验证规则错误消息</label>
                <input type="text" class="form-control" name="validate_msg" placeholder="标题" value="<?=$m['validate_msg']?>">
                <small>验证规则错误消息格式（需要与规则字段一一对应）：字段|规则1+规则2+规则3=参数1,参数2;字段2|规则1+规则2+规则3=参数;字段3|规则1+....</small>
            </div>
        </div>
    </div>
                         <!--table class="table table-bordered table-hover">
                             <thead>
                             <th>字段</th>
                             <th>验证规则</th>
                             <th>错误消息</th>
                             </thead>
                             <tbody>

                             <?
                                //解析验证规则
                                $valis =explode(';',trim($m['validate_rule'],';'));
                                $valimsgs = explode(';',trim($m['validate_msg'],';'));

                                $validates = [];
                                foreach ($valis as $v){

                                    $vs = explode('|',$v);
                                    $field = $vs[0];
                                    $vrules = explode('+',$vs[1]);

                                    $validates[$field]=$vrules;

                                }

                                $validatamsgs=[];
                                foreach ($valimsgs as $v){

                                    $vs = explode('|',$v);
                                    $field = $vs[0];
                                    $vmsgs = explode('+',$vs[1]);

                                    $validates[]=[$field=>$vmsgs];
                                }

                             foreach ($fields as $f){

                                 //验证规则列表
                                 $rs = $validates[$f['name']];
                                 /*$ismust = in_array('must',$rs);
                                 $ismobile = in_array('mobile',$rs);
                                 $istel = in_array('tel',$rs);
                                 $ispostcode = in_array('postcode',$rs);
                                 $isemail = in_array('email',$rs);
                                 $isqq = in_array('qq',$rs);
                                 $isidcard = in_array('idcard',$rs);
                                 $isurl = in_array('url',$rs);
                                 $isip = in_array('ip',$rs);*/


                                 ?>
                             <tr>
                                 <td><?=$f['name']?><small><?=$f['title']?></small></td>
                                 <td class="validate">

<!--
                                     <label><input type="checkbox" name="<?=$f['name']?>.must" value="1" <?=$ismust?'checked':''?>>必填</label>

                                     <label>
                                         <select name="<?=$f['name']?>.type">
                                             <option value="">不限</option>
                                             <option value="mobile">手机</option>
                                             <option value="tel">电话</option>
                                             <option value="postcode">邮编</option>
                                             <option value="email">email</option>
                                             <option value="qq">qq</option>
                                             <option value="idcard">身份证</option>
                                             <option value="url">网址</option>
                                             <option value="ip">IP</option>
                                         </select>
                                     </label>

                                     <label>
                                         <select name="<?=$f['name']?>.char">
                                             <option value="">不限</option>
                                             <option value="alphaNumDash">字母数字下划线</option>
                                             <option value="alpha">字母</option>
                                             <option value="alphaNum">字母数字</option>
                                             <option value="alphaNumDashChinese">字母数字中文下划线</option>
                                             <option value="chinese">中文</option>
                                         </select>
                                         <input type="number" placeholder="最小位数" name="<?=$f['name']?>.char.min">
                                         <input type="number" placeholder="最小位数" name="<?=$f['name']?>.char.max">
                                     </label>
<?

?>
                                     <label>
                                         <select name="<?=$f['name']?>.num" onchange="if(this.value==''){$('#div_number_<?=$f['name']?>').hide();$('#div_double_<?=$f['name']?>').hide();}else if(this.value=='int'){$('#div_number_<?=$f['name']?>').show();$('#div_double_<?=$f['name']?>').hide();}else{$('#div_double_<?=$f['name']?>').show();$('#div_number_<?=$f['name']?>').hide();}">
                                             <option value="">不限</option>
                                             <option value="int">整数</option>
                                             <option value="double">小数</option>
                                         </select>
                                         <span id="div_number_<?=$f['name']?>" style="display: none;"><input type="number" placeholder="最小值" name="<?=$f['name']?>.num.min">-<input type="number" style="width: 60px" placeholder="最大值" name="<?=$f['name']?>.num.max"></span>
                                         <span id="div_double_<?=$f['name']?>" style="display: none;"><input type="number" placeholder="小位数" name="<?=$f['name']?>.num.double"></span>
                                     </label>


                                     <br>
                                     <label>
                                         <input type="checkbox"  name="<?=$f['name']?>.equal" value="equal">等于
                                         <select>
                                             <?foreach ($fields as $a){?>
                                             <option value="<?=$a['name']?>"><?=$a['name']?></option>
                                            <?}?>
                                         </select>
                                     </label>
                                     <label>
                                         <input type="checkbox" value="noequal" name="<?=$f['name']?>.noequal">不等于
                                         <select>
                                             <?foreach ($fields as $a){?>
                                                 <option value="<?=$a['name']?>"><?=$a['name']?></option>
                                             <?}?>
                                         </select>
                                     </label>
                                     <label>
                                         <input type="checkbox" value="unique" name="<?=$f['name']?>.unique">唯一
                                     </label>
                                     <label>
                                         <input type="checkbox" value="regex" name="<?=$f['name']?>.regex">正则
                                         <input type="text" name="<?=$f['name']?>.regex_val" style="width: 200px">
                                     </label>

                                 </td>
                                <td id="validate_msg" class="validate_msg">

                                </td>
                             </tr>

                             <?}?>
                             </tbody>
                         </table> -->
    <input type="submit" value="保存" class="btn btn-primary">
    <input type="reset" value="重置" class="btn btn-info">
</form>

                    </div>
                </div>
            </div>
        </div>

    </div>
<style>
    .validate *{
        font-size: 12px !important;

    }
    .validate label{
        border: 1px solid #999;
        padding: 5px;
        border-radius: 5px;
        margin: 10px;
    }
    .validate input[type='number']{
        border-radius: 3px;
        width: 60px;

    }

</style>
<?import('/layout/bottom.php');?>
<?function js(){?>


<?}?>