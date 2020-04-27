<?php
namespace heephp\cache;

interface cacheInterface{
    public function __construct($exp_time);

    public function set($key,$data);
    public function get($ke);
    public function remove($key);
    public function clear();
}