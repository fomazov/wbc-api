<?php

namespace WBC\Lib\Cache\StorageType;


class Apc extends AbstractType
{
    public function get($key)
    {
        return apc_fetch($key);
    }

    public function set($key, $data)
    {
        apc_store($key, $data);
    }
}