<?php

namespace WBC\Lib\Cache\StorageType;


abstract class AbstractType
{
    abstract public function get($key);
    abstract public function set($key, $data);
}