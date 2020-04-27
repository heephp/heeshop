<?php
namespace heephp\cache;

use heephp\sysExcption;

class redis implements cacheInterface{

    private $exp_time;
    private $redis;

    public function __construct($exp_time=1)
    {

        $conf = config('cache.');
        $this->exp_time=$conf['exp_time']?:$exp_time;

        $conf = $conf['redis'];

        $this->redis=new \Redis();
        if(!$this->redis->connect($conf['host'],$conf['port'])){

            throw new sysExcption('Redis 服务器连接失败：'.$conf['host'].'.'.$conf['port']);

        }


    }

    public function get($key)
    {
        // TODO: Implement get() method.
        $value = $this->redis->get($key);
        if($value)
        {
            $result = @json_decode($value,true);

            if ($result === NULL) {
                return $value;
            }

            return $result;

        }else{

            return false;

        }

    }

    public function set($key, $data)
    {
        // TODO: Implement set() method.
        if(is_array($data)){

            $this->redis->setex($key, $this->exp_time,json_encode($data,false));

        }else{

            $this->redis->setex($key, $this->exp_time,$data);

        }
    }

    public function remove($key)
    {
        return $this->redis->del($key)>0;
    }

    public function clear(){
        return $this->redis->flushAll();
    }

}