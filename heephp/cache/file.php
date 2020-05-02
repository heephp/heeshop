<?php
namespace heephp\cache;
use heephp\logger;

class file implements cacheInterface{

    private $cache_path;//path for the file

    private $cache_expire;//seconds that the file expires

    //file constructor, optional expiring time and file path

    public function __construct($exp_time=1){

        $cfexp = config('cache.exp_time');
        $this->cache_expire=$cfexp?:$exp_time;

        $this->cache_path=ROOT.'/runtime/cache/';

        //echo $this->cache_path;
        if(!is_dir($this->cache_path)){
            mkdir($this->cache_path,777,true);
        }

    }


    //returns the filename for the file

    private function fileName($key){

        return $this->cache_path.md5($key);

    }



    //creates new file files with the given data, $key== name of the file, data the info/values to store

    public function set($key, $data){

        $values = serialize($data);

        $filename = $this->fileName($key);

        $file = fopen($filename, 'w');

        if ($file){//able to create the file

            fwrite($file, $values);

            fclose($file);

        }

        else

            return false;

    }



    //returns file for the given key

    public function get($key){

        $filename = $this->fileName($key);

        if (!file_exists($filename) || !is_readable($filename)){//can't read the file

            return false;

        }

        if(time()-((filemtime($filename))+$this->cache_expire)<0){//file for the key not expired

            $file = fopen($filename, "r");// read data file

            if ($file){//able to open the file

                $data = fread($file, filesize($filename));

                fclose($file);

                return unserialize($data);//return the values

            }

            else return false;

        }
        else{
            return false;//was expired you need to create new
        }

    }

    public function remove($key){

        $filename = $this->fileName($key);

        if (file_exists($filename)){//can't read the file
            return unlink($filename);
        }
    }

    public function clear()
    {
        $path = $this->cache_path;

        foreach_dir($path,function ($val,$path) {

                if (is_file($path . $val)) {

                    //如果是文件直接删除
                    @unlink($path . $val);
                }

        });
        return true;

    }

}

?>