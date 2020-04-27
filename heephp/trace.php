<?php
namespace heephp;

class trace{

    private static $sqls=[];
    private function __construct()
    {

    }

    public static function record_sql($sql){
        if(config('debug')==true) {
            trace::$sqls[] = $sql;
        }
    }

    public static function page_trace()
    {
        if(config('debug')==true) {
            $traces = debug_backtrace();
            $sqls = trace::$sqls;
            //加载显示完成后 清空记录
            trace::$sqls=[];
            include 'message/trace.php';
        }
    }

    /**
     * 设置页面开始执行时间
     * 以计算脚本运行时间
     */
    public static function set_run_start_time(){
        list($usec, $sec) = explode(" ", microtime());
        $time = intval(((float)$usec + (float)$sec) * 1000);
        request('session.page_run_start_time',$time);
    }

    /**
     * 计算页面总运行时间
     */
    public static function sum_run_end_time(){
        $starttime = request('session.page_run_start_time');

        list($usec, $sec) = explode(" ", microtime());
        $endtime = intval(((float)$usec + (float)$sec) * 1000);

        $spentime=$endtime-$starttime;

        return  $spentime.'ms';
    }

}