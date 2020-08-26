<?php

namespace WBC\Helpers;


trait CacheHelper
{
    public static $provider = array();

    public function getCache($prefix, $key, $defaultData = false)
    {
        if(!isset(static::$provider[$prefix])) {
            return $defaultData;
        }

        if(!isset(static::$provider[$prefix][$key])) {
            return $defaultData;
        }

        return static::$provider[$prefix][$key];
    }

    public function setCache($prefix, $key, $data)
    {
        if(!isset(static::$provider[$prefix])) {
            static::$provider[$prefix] = array();
        }

        static::$provider[$prefix][$key] = $data;
    }
}