<?php
namespace heephp\orm;
class wherebuilder{
    private $sql='';

    public function where($where)
    {
        if(!empty($this->sql))
            $this->sql.=' and ';

        if (is_array($where)) {
            $w = '';
            foreach ($where as $k => $v) {
                $w .= "`$k`='$v' and ";
            }
            $w = substr($w, 0, strlen($w) - 4);
            $this->sql .=  '(' . $w . ')';
        } else {
            $this->sql .=  "($where)";
        }

        return $this;
    }

    public function whereIn($filed,$where)
    {
        if(!empty($this->sql))
            $this->sql.=' and ';

        $relation =' in ';
        if (is_callable($where)) {
            $this->sql .= " $filed $relation (" . $where($this) . ')';
        } else {
            if (is_array($where)) {
                $this->sql .= $filed . $relation . '(' . implode(',', $where) . ')';
            } else {
                $this->sql .= $filed . $relation . "($where)";
            }
        }
        return $this;
    }
    public function whereNotIn($filed,$where)
    {
        if(!empty($this->sql))
            $this->sql.=' and ';

        $relation =' not in ';
        if (is_callable($where)) {
            $this->sql .= " $filed $relation (" . $where($this) . ')';
        } else {
            if (is_array($where)) {
                $this->sql .= $filed . $relation . '(' . implode(',', $where) . ')';
            } else {
                $this->sql .= $filed . $relation . "($where)";
            }
        }
        return $this;

    }
    public function whereBetween($filed,$v1,$v2){
        if(!empty($this->sql))
            $this->sql.=' and ';

        $this->sql.= " $filed between $v1 and $v2 ";
        return $this;
    }
    public function whereNotBetween($filed,$v1,$v2){
        if(!empty($this->sql))
            $this->sql.=' and ';

        $this->sql.= " $filed not between $v1 and $v2 ";
        return $this;
    }
    public function whereIsNULL($filed){
        if(!empty($this->sql))
            $this->sql.=' and ';

        $this->sql.= " $filed is null ";
        return $this;
    }
    public function whereIsNotNULL($filed){
        if(!empty($this->sql))
            $this->sql.=' and ';

        $this->sql.= " $filed is not null ";
        return $this;
    }
    public function whereAnd($where){
        if(!empty($this->sql))
            $relation = ' and ';

        if (is_callable($where)) {
            $this->sql .= " $relation (" . $where(new wherebuild()) . ')';
        } else {
            if (is_array($where)) {
                $w = '';
                foreach ($where as $k => $v) {
                    $w .= "`$k`='$v' $relation";
                }
                $w = substr($w, 0, strlen($w) - 4);
                $this->sql .= $relation . '(' . $w . ')';
            } else {
                $this->sql .= $relation . "($where)";
            }
        }
        return $this;
    }
    public function whereOr($where){
        if(!empty($this->sql))
            $relation = ' or ';

        if (is_callable($where)) {
            $this->sql .= " $relation (" . $where(new wherebuild()) . ')';
        } else {
            if (is_array($where)) {
                $w = '';
                foreach ($where as $k => $v) {
                    $w .= "`$k`='$v' $relation";
                }
                $w = substr($w, 0, strlen($w) - 4);
                $this->sql .= $relation . '(' . $w . ')';
            } else {
                $this->sql .= $relation . "($where)";
            }
        }
        return $this;
    }
    public function sql(){
        return $this->sql;
    }
}