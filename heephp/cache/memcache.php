<?php
namespace heephp\cache;
use heephp\cache\cacheInterface;
use heephp\sysExcption;

class memcache implements cacheInterface{

    private $memcache;
    private $exp_time;

    public function __construct($exp_time=1){

        $conf = config('cache.');
        $this->exp_time=$conf['exp_time']?:$exp_time;

        $conf = $conf['memcache'];
        $this->memcache = new \Memcache();

        if(!$this->memcache->connect($conf['host'],$conf['port'],$this->exp_time)){

            throw new sysExcption('连接Memcache服务器失败：'.$conf['host'].':'.$conf['port']);
        }

    }

    public function set($key,$data){

        return $this->memcache->set($key,$data,MEMCACHE_COMPRESSED,$this->exp_time);

    }

    public function get($key){
        $val = $this->memcache->get($key);
        return $val;
    }

    public function remove($key){
        return $this->memcache->delete($key);
    }

    public function clear(){
        return $this->memcache->flush();
    }

}