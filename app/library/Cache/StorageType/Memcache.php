<?php

namespace WBC\Lib\Cache\StorageType;

use Memcache as MemcacheLib;

class Memcache extends AbstractType
{
    /**
     * @var bool|MemcacheLib
     */
    private $api = false;

    public function __construct()
    {
        $server   = 'localhost';
        $this->api = new MemcacheLib;
        $this->api->connect($server);
    }

    public function get($key)
    {
        return $this->api->get($key);
    }

    public function set($key, $data)
    {
        $this->api->set($key, $data);
    }
}