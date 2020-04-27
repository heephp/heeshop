<?php
namespace heephp\bulider;


class table{
    private $item=[];
    private $data=[];
    private $html_table;
    private $table_cls=[];
    private $table_header_cls='';
    private $btns=[];

    /**
     * table constructor.
     * @param $item [['标题','field','len']....]
     * @param array $data
     */
    public function __construct($item=[],$data=[])
    {
        $this->setColum($item);
        $this->setData($data);
    }

    public function setColum($item)
    {
        $col = [];
        for ($i = 0; $i < count($item); $i++) {
            if ($i == 0)
                $col['title'] = $item[0];
            if ($i == 1)
                $col['field'] = $item[1];
            if ($i == 2)
                $col['len'] = $item[2];
        }

        if (count($col) > 0)
            $this->item[] = $col;
    }

    public function setData($data){
        $this->data = $data;
    }

    public function bulider(){

        $cls = implode(' ',$this->table_cls);

        //构造标题
        $title='<thead class="'.$this->table_header_cls.'"><tr>';

        foreach ($this->item as $it){
            if($it['title']){
                $title.='<th>'.$it['title'].'</th>';
            }
        }
        $title.='<th>操作</th>';
        $title.='</tr></thead>';

        //构造数据
        $rows=[];
        foreach ($this->data as $d) {
            $row = '<tr>';
            foreach ($this->item as $it) {
                $row .= '<td>' . sstr($d[$it['field']], $it['len'] ?? 10) . '</td>';
            }

            //构造按钮
            $btns='';
            foreach ($this->btns as $btn) {
                $parms = [];
                foreach ($btn['link_parms'] as $p) {
                    $parms[] = $d[$p];
                }
                $btns .= $this->btn($btn['title'], $btn['action'], $parms, $btn['type'], $btn['click'], $btn['level']);
            }
            $row.='<td>'.$btns.'</td>';

            $row .= '</tr>';
            $rows[] = $row;
        }

        $ht="<table class=\"$cls\">".$title.'<tbody>'.implode('',$rows).'</tbody>'."</table>";

        $this->html_table = $ht;
        return $this->html_table;
    }

    /***
     * 设置标题
     * @param $title
     * @param string $link
     * @param string $type  edit编辑按钮  delete删除按钮
     * @param string $click
     * @param string $level
     * @return string
     */
    private function btn($title='编辑',$action='',$link_parms=[],$type='edit',$click='',$level='primary')
    {
        $click = empty($click) ? '' : 'click="' . $click . '"';
        $cls = ($type == 'del' || $type == 'delete' || $action == 'del' || $action == 'delete') ? ' delete' : '';
        $level = ($type == 'del' || $type == 'delete' || $action == 'del' || $action == 'delete') ? 'danger' : $level;

        $ht = "<a href=\"" . url($action, $link_parms) . "\" class=\"btn btn-$level $cls\"  $click > $title </a>";
        return $ht;
    }

    public function setBtn($title='编辑',$action='',$link_parms=[],$type='edit',$click='',$level='primary')
    {
        $this->btns[]=['title'=>$title,'action'=>$action,'link_parms'=>$link_parms,'click'=>$click,'level'=>$level];
    }

    public function show(){
        return $this->html_table;
    }

    public function setClass($cls){
        $this->table_cls = $cls;
    }

    public function setHeaderClass($cls){
        $this->table_header_cls = $cls;
    }
}