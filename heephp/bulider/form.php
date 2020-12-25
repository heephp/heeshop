<?php
namespace heephp\bulider;
/**
 * heephp formbulider
 *
 * Class formbulider
 * @package heephp
 *
 */
class form{

    private $name ='';
    private $html_form='';
    private $method='get';
    private $action ='';
    private $hasfile =false;
    private $is_row=false;//是否是水平表单
    private $row_width=[2,10];//水平表单的左右两列宽度
    private $attr='';

    public function __construct($action,$method='get',$name="",$hasfile=false)
    {
        $this->name = $name;
        $this->action = $action;
        $this->method = $method;
        $this->hasfile = $hasfile;

    }

    private function input($type,$lable,$name,$value='',$placehoder='',$desc='',$min='',$max='',$step='1',$checked=false,$colwidth=0){

        //如果是单行表单
        if($this->is_row){
            return $this->input_row($type,$lable,$name,$value,$placehoder,$desc,$min,$max,$step,$checked);
        }

        $range = (!empty($min)?"min=\"$min\" max=\"$max\" step=\"$step\"":'');

        $group_cls = ($type=='checkbox'||$type=='radio')?'form-check':'form-group';
        $input_cls = ($type=='checkbox'||$type=='radio')?'form-check-input':'form-control';
        $label_cls = ($type=='checkbox'||$type=='radio')?'class="form-check-sign"':'';
        $checkedstr = ($type=='checkbox'||$type=='radio')&&$checked?'checked':'';
        $colwidthstr = $colwidth>0?" col-sm-".$colwidth:'';


        $label = " <label for=\"$name-$value\" $label_cls>$lable</label>";
        $input = "<input type=\"$type\" class=\"$input_cls\" id=\"$name-$value\" name=\"$name\" value=\"$value\"  placeholder=\"$placehoder\" $range $checkedstr $this->attr >";
        $desc = empty($desc)?'':"<small class=\"form-text text-muted\">$desc</small>";

        $ht = ($type=='radio'||$type=='checkbox')?$input.$label.$desc:$label.$input.$desc;

        $ht = "<div class=\"$group_cls $colwidthstr\">
                $ht
              </div>";

        return $ht;
    }

    private  function input_row($type,$lable,$name,$value='',$placehoder='',$desc='',$min='',$max='',$step='1',$checked=false){

        $range = ($type=='range'&&!empty($min))?"min=\"$min\" max=\"$max\" step=\"$step\"":'';

        $group_cls = ($type=='checkbox'||$type=='radio')?'form-check form-check-inline':'form-group row';
        $input_cls = ($type=='checkbox'||$type=='radio')?'form-check-input':'form-control';
        $label_cls = ($type=='checkbox'||$type=='radio')?'':"class=\"col-sm-".$this->row_width[0]." col-form-label\"";
        $checkedstr = ($type=='checkbox'||$type=='radio')&&$checked?'checked':'';

        $label = " <label for=\"$name-$value\" $label_cls>$lable</label>";
        $input = "<input type=\"$type\" class=\"$input_cls\" id=\"$name-$value\" name=\"$name\" value=\"$value\"  placeholder=\"$placehoder\" $range $checkedstr $this->attr >";
        $desc = empty($desc)?'':"<small class=\"form-text text-muted\">$desc</small>";

        $input = ($type=='checkbox'||$type=='radio')?$input:"<div class=\"col-sm-".$this->row_width[1]."\">".$input."</div>";
        $ht = ($type=='radio'||$type=='checkbox')?$input.$label.$desc:$label.$input.$desc;

        $ht = "<div class=\"$group_cls\">
                $ht
              </div>";

        return $ht;

    }

    public function select($lable,$name,$items=[],$value='',$multiple=false,$desc='')
    {
        $ht=$this->_select($lable, $name, $items, $value,$multiple, $desc);

        $this->html_form .= $ht;
        return $this;
    }

    private function _select($lable,$name,$items=[],$value='',$multiple=false,$desc='',$colwidth=0){
        $vs = $multiple?'':'<option value="">未选择</option>';
        foreach ($items as $k=>$v){
            $sed = $k==$value?'selected':'';
            $vs.="<option value=\"$k\" $sed>$v</option>";
        }

        $multiplestr = $multiple?'multiple':'';
        $select = "<select class=\"form-control\" id=\"$name\" name=\"$name\" $multiplestr $this->attr>
                        $vs                    
                    </select>
                    <small class=\"form-text text-muted\">$desc</small>";

        $colwidthstr = $colwidth&&!$this->is_row>0?'col-sm-'.$colwidth:'';
        $row_cls = $this->is_row?'row':'';
        $label_cls = $this->is_row?'class="col-sm-'.$this->row_width[0].'"':'';
        $select =$this->is_row?"<div class='col-sm-".$this->row_width[1]."'>".$select."<small>$desc</small></div>":$select;

        $ht = "  <div class=\"form-group $row_cls $colwidthstr\">
                    <label for=\"$name\" $label_cls>$lable</label>
                    $select
                  </div>";
        return $ht;
    }

    public function text($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['text',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function number($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['number',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function url($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['url',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function email($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['email',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function range($lable,$name,$value='',$min,$max,$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['range',$lable,$name,$value,$placehoder,$desc,$min,$max]);
        return $this;
    }

    public function date($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['date',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function time($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['time',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function month($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['month',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function week($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['week',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function datetime_local($lable,$name,$value='',$placehoder='',$desc=''){
        $this->html_form.=call_user_func_array([$this,'input'],['datetime-local',$lable,$name,$value,$placehoder,$desc]);
        return $this;
    }

    public function radio($lable,$name,$value='',$checked=false){
        $this->html_form.=call_user_func_array([$this,'input'],['radio',$lable,$name,$value,'','','','','',$checked]);
        return $this;
    }

    public function checkbox($lable,$name,$value='',$checked=false){
        $this->html_form.=call_user_func_array([$this,'input'],['checkbox',$lable,$name,$value,'','','','','',$checked]);
        return $this;
    }

    /**
     * 带标题的单选组
     * @param $title
     * @param array $items [[lable=>'',value=>''],...]
     */
    public function radios($title,$name,$items=[],$value=''){
        $ht='';
        $checked=false;
        foreach ($items as $it) {
            if($it['value']==$value)
                $checked = true;
            else
                $checked = false;
            $ht.=call_user_func_array([$this,'input'],['radio',$it['label'],$name,$it['value'],'','','','','',$checked]);
        }

        $rows_cls = $this->is_row?'row':'';
        $rows_cls_label=$this->is_row?"class=\"col-sm-".$this->row_width[0]."\"":'';
        $ht =$this->is_row?"<div class=\"col-sm-".$this->row_width[1]."\">".$ht."</div>":$ht;

        $ht="<div class=\"form-group $rows_cls\"><label $rows_cls_label>$title</label>$ht</div>";
        $this->html_form.=$ht;

        return $this;
    }

    /**
     * 带标题的多选组
     * @param $title
     * @param array $items [[lable=>'',value=>''],...]
     */
    public function checkboxs($title,$name,$items=[],$value=[]){
        $ht='';
        $checked=false;
        foreach ($items as $it) {
            if(in_array($it['value'],$value))
                $checked = true;
            else
                $checked = false;
            $ht.=call_user_func_array([$this,'input'],['checkbox',$it['label'],$name,$it['value'],'','','','','',$checked]);
        }

        $rows_cls = $this->is_row?'row':'';
        $rows_cls_label=$this->is_row?"class=\"col-sm-".$this->row_width[0]."\"":'';
        $ht =$this->is_row?"<div class=\"col-sm-".$this->row_width[1]."\">".$ht."</div>":$ht;

        $ht="<div class=\"form-group $rows_cls\"><label $rows_cls_label>$title</label>$ht</div>";
        $this->html_form.=$ht;

        return $this;
    }


    public function textarea($lable,$name,$value='',$line=3,$palcehoder='')
    {
        $ht = '';
        if ($this->is_row) {
            $ht = "<div class=\"form-group row\">
                    <label for=\"$name\" class=\"col-sm-".$this->row_width[0]." col-form-label\">$lable</label>
                    <div class=\"col-sm-".$this->row_width[1]."\">
                        <textarea class=\"form-control\" id=\"$name\" name=\"$name\" rows=\"$line\" placeholder='$palcehoder' $this->attr></textarea>
                    </div>
                  </div>";
        } else {
            $ht = "<div class=\"form-group\">
                        <label for=\"$name\">$lable</label>
                        <textarea class=\"form-control\" id=\"$name\" name=\"$name\" rows=\"$line\" placeholder='$palcehoder'></textarea>
                      </div>";
        }
        $this->html_form .= $ht;
        return $this;
    }

    public function file($label,$name,$value=''){
        $this->hasfile=true;
        $ht='';
        if($this->is_row){
            $ht = "<div class=\"form-group row\">
                    <label for=\"$name\" class=\"col-sm-".$this->row_width[0]." col-form-label\">$label</label>
                    <div class=\"col-sm-".$this->row_width[1]."\">
                        <input type=\"file\" class=\"form-control-file\" name=\"$name\" id=\"$name\">
                    </div>
                  </div>";
        }else{
            $ht="<div class=\"form-group\">
                    <label for=\"$name\">$label</label>
                    <input type=\"file\" class=\"form-control-file\" name=\"$name\" id=\"$name\">
                  </div>";
        }
        $this->html_form.=$ht;
        return $this;
    }

    public function ueditor($label,$name,$value=''){
        $ht='';
        if($this->is_row){
            $ht = "<div class=\"form-group row\">
                    <label for=\"$name\" class=\"col-sm-".$this->row_width[0]." col-form-label\">$label</label>
                    <div class=\"col-sm-".$this->row_width[1]."\">
                         <script id=\"$name\" class=\"ueditor\" name=\"$name\" type=\"text/plain\">
                            $value
                        </script>
                    </div>
                  </div>";
        }else{
            $ht="<div class=\"form-group\">
                    <label for=\"$name\">$label</label>
                    <div>
                    <script id=\"$name\" class=\"ueditor\" name=\"$name\" type=\"text/plain\">
                            $value
                        </script>
                    </div>
                  </div>";
        }
        $this->html_form.=$ht;
        return $this;
    }

    public function rowStart(){
        $this->html_form.=$this->is_row?'':"<div class=\"form-row\">";
        return $this;
    }
    public function rowInput($lable,$name,$value='',$colwidth=6,$type='text',$placehoder='',$desc='',$min='',$max='',$step='1',$checked=false){
        $this->html_form.=$this->input($type,$lable,$name,$value,$placehoder,$desc,$min,$max,$step,$checked,$colwidth);
        return $this;
    }
    public function rowSelect($lable,$name,$items=[],$value='',$colwidth=6,$multiplestr=false,$desc=''){
        $this->html_form.=$this->_select($lable,$name,$items,$value,$multiplestr,$desc,$colwidth);
        return $this;
    }
    public function rowEnd(){
        $this->html_form.=$this->is_row?'':"</div>";
        return $this;
    }
    public function hidden($name,$value){
        $this->html_form.="  <input type=\"hidden\" name=\"$name\" value=\"$value\">";
        return $this;
    }
    /*color:primary secondary success danger warning info light dark*/
    public function submit($color='primary',$title="提交"){
        $this->html_form.="  <input type=\"submit\" class=\"btn btn-$color\" value='$title'/>";
        return $this;
    }
    public function rest($color='secondary',$title="重置"){
        $this->html_form.="  <input type=\"reset\" class=\"btn btn-$color\" value='$title'/>";
        return $this;
    }
    public function button($title,$click='',$color='secondary'){
        $click=empty($click)?'':"onclick=\"$click\"";
        $this->html_form.="  <input type=\"button\" class=\"btn btn-$color\" value='$title' $click/>";
        return $this;
    }
    public function customer($html){
        $this->html_form.=$html;
        return $this;
    }

    public function show(){

        $enctype = $this->hasfile?"enctype=\"multipart/form-data\"":'';
        $this->html_form = "<form id=\"$this->name\" name=\"$this->name\" action=\"$this->action\" method=\"$this->method\" $enctype>".$this->html_form.'</form>';

        return space($this->html_form);
    }


    /**
     *设置为水平显示表单
     */
    public function set_row($val,$width=[2,10]){
        $this->is_row = $val;
        $this->row_width = $width;
    }

    /**
     * 设置输入框属性
     * @param $attr
     */
    public function set_attr($attr){
        $this->attr = $attr;
    }
    public function __destruct()
    {
        $this->html_form = '';
    }

}