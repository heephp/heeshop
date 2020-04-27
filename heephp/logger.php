<?php
namespace heephp;

define('LEVEL_FATAL', 0);
define('LEVEL_ERROR', 1);
define('LEVEL_WARN', 2);
define('LEVEL_INFO', 3);
define('LEVEL_DEBUG', 4);

class logger {

    static $LOG_LEVEL_NAMES = array(
        'FATAL', 'ERROR', 'WARN', 'INFO', 'DEBUG'
    );

    private $level = LEVEL_DEBUG;

    private static function getInstance() {
        return new logger;
    }

    /**
     * 设置最小的log记录级别，小于该级别的log日志输出将被忽略掉
     * @param int $lvl -- 最小的log日志输出级别
     * @throws Exception
     */
    private function setLogLevel($lvl) {
        if($lvl >= count(logger::$LOG_LEVEL_NAMES)  || $lvl < 0) {
            throw new sysExcption('invalid log level:' . $lvl);
        }
        $this->level = $lvl;
    }

    //###################输出各个级别的日志信息---start==============
    public static function debug($message, $name = 'root') {
        $log = logger::getInstance();
        $log->_log(LEVEL_DEBUG, $message, $name);
    }
    public static function info($message, $name = 'root') {
        $log = logger::getInstance();
        $log->_log(LEVEL_INFO, $message, $name);
    }
    public static function warn($message, $name = 'root') {
        $log = logger::getInstance();
        $log->_log(LEVEL_WARN, $message, $name);
    }
    public static function error($message, $name = 'root') {
        $log = logger::getInstance();
        $log->_log(LEVEL_ERROR, $message, $name);
    }
    public static function fatal($message, $name = 'root') {
        $log = logger::getInstance();
        $log->_log(LEVEL_FATAL, $message, $name);
    }
    //###################输出各个级别的日志信息---end==============

    /**
     * 记录log日志信息
     * @param unknown_type $level
     * @param unknown_type $message
     * @param unknown_type $name
     */
    private function _log($level, $message, $name) {

        if(config('logger')==false){
            return;
        }
        if($level > $this->level) {
            return;
        }

        $log_file_dir = ".\\..\\runtime\\log\\".date('Ymd').'\\';
        $log_file_path = $log_file_dir.date('YmdH').'.log';

        //echo $log_file_path;exit;
        if(!is_dir($log_file_dir)){
            if(!mkdir($log_file_dir,777,true)){
                return;
            }
        }

        $log_level_name = logger::$LOG_LEVEL_NAMES[$this->level];
        $content = date('Y-m-d H:i:s') . ' [' . $log_level_name . '] '."[$name]" . $message . "\n";
        file_put_contents($log_file_path, $content, FILE_APPEND);
    }

}