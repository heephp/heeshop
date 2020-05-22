<?php
namespace heephp\cache;
use heephp\cache\cacheInterface;
use heephp\sysExcption;

class memcached implements cacheInterface{

    private $memcached;
    private $exp_time;

    public function __construct($exp_time=1){

        $conf = config('cache.');
        $this->exp_time=$conf['exp_time']?:$exp_time;

        $conf = $conf['memcached'];
        $this->memcached = new \Memcached();


        if(!$this->memcached->addServer($conf['host'],$conf['port'])){

            throw new sysExcption('连接Memcached服务器失败：'.$conf['host'].':'.$conf['port']);
        }

    }

    public function set($key,$data){

        return $this->memcached->set($key,$data,$this->exp_time);

    }

    public function get($key){
        $val = $this->memcached->get($key);
        return $val;
    }

    public function remove($key){
        return $this->memcached->delete($key);
    }

    public function clear(){
        return $this->memcached->flush();
    }

}