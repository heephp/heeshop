<?php
namespace heephp\bulider;


class table
{
    private $item = [];
    private $data = [];
    private $html_table;
    private $table_cls = [];
    private $table_header_cls = '';
    private $btns = [];

    //显示为链接的列
    private $link_columns = [];
    //字段限定长度的列
    private $len_columns = [];
    //限定显示的字符长度
    private $default_len = 10;

    /**
     * table constructor.
     * @param $item [['标题','field','len']....]
     * @param array $data
     */
    public function __construct($item = [], $data = [])
    {
        if (!empty($item))
            $this->setColum($item);
        if (!empty($data))
            $this->setData($data);
    }

    public function setColum($items)
    {
        foreach ($items as $item) {
            $col = ['title' => $item[0], 'field' => $item[1], 'len' => $item[2] ?? 10];
            $this->item[] = $col;
        }
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * 设置显示为链接的列
     * @param $columns
     */
    public function setLinkColumns($columns)
    {
        $this->link_columns = $columns;
    }

    /**
     * 设置显示为限定字符长度的列
     * @param $columns
     */
    public function setLenColumns($columns)
    {

        $this->len_columns = $columns;
    }

    /**
     * 设置截取字符串长度，的位数
     * @param $len
     */
    public function setDefaultLen($len)
    {
        $this->default_len = $len;
    }

    public function bulider()
    {

        $cls = implode(' ', $this->table_cls);

        //构造标题
        $title = '<thead class="' . $this->table_header_cls . '"><tr>';

        foreach ($this->item as $it) {
            $title .= '<th>' . $it['title'] ?? '' . '</th>';
        }
        $title .= '<th>操作</th>';
        $title .= '</tr></thead>';

        //构造数据
        $rows = [];
        foreach ($this->data as $d) {
            $row = '<tr>';
            foreach ($this->item as $it) {
                $row .= '<td title="' . $d[$it['field']] . '">';

                if (in_array($it['field'], $this->len_columns))
                    $row .= sstr($d[$it['field']], $it['len'] ?? $this->default_len);

                else if (in_array($it['field'], $this->link_columns))
                    $row .= '<a href="' . $d[$it['field']] . '" target="_blank" title="'. $d[$it['field']] .'">查看</a>';

                else
                    $row .= $d[$it['field']];

                $row .= '</td>';
            }

            //构造按钮 按钮数量 以计算宽度
            $btns = '';
            $btncount = 0;
            foreach ($this->btns as $btn) {
                $parms = [];
                foreach ($btn['link_parms'] as $p) {
                    $parms[] = $d[$p];
                }
                $btns .= $this->btn($btn['title'], $btn['action'], $parms, $btn['type'], $btn['click'], $btn['level']);
                $btncount++;
            }
            $row .= '<td style="width:' . ($btncount * 80) . 'px">' . $btns . '</td>';

            $row .= '</tr>';
            $rows[] = $row;
        }

        $ht = "<table class=\"$cls\">" . $title . '<tbody>' . implode('', $rows) . '</tbody>' . "</table>";

        $this->html_table = $ht;
        return $this->html_table;
    }

    /***
     * 设置标题
     * @param $title
     * @param string $link
     * @param string $type edit编辑按钮  delete删除按钮
     * @param string $click
     * @param string $level
     * @return string
     */
    private function btn($title = '编辑', $action = '', $link_parms = [], $type = 'edit', $click = '', $level = 'primary')
    {
        $click = empty($click) ? '' : 'click="' . $click . '"';
        $cls = ($type == 'del' || $type == 'delete' || $action == 'del' || $action == 'delete') ? ' delete' : '';
        $level = ($type == 'del' || $type == 'delete' || $action == 'del' || $action == 'delete') ? 'danger' : $level;

        $ht = "<a href=\"" . url($action, $link_parms) . "\" class=\"btn btn-$level $cls btn-sm mr-1\"  $click > $title </a>";
        return $ht;
    }

    public function setBtn($title = '编辑', $action = '', $link_parms = [], $type = 'edit', $click = '', $level = 'primary')
    {
        $this->btns[] = ['title' => $title, 'action' => $action, 'link_parms' => $link_parms, 'click' => $click, 'level' => $level];
    }

    public function show()
    {
        return $this->html_table;
    }

    public function setClass($cls)
    {
        $this->table_cls = $cls;
    }

    public function setHeaderClass($cls)
    {
        $this->table_header_cls = $cls;
    }
}