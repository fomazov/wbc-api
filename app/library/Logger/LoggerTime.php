<?php

use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;

class LoggerTime
{
    const ALLOW_DEBUG = false;

    public static $_startTime = false;
    public static $_instance = false;

    public static function log($msg)
    {
        if(!self::ALLOW_DEBUG) {
            return false;
        }

        $instance = self::getInstance();
        $milSecond = microtime(true) - self::$_startTime;

        $instance->log('[s:'.$milSecond.']'.$msg);
    }

    public static function getInstance()
    {
        if(self::$_instance) {
            return self::$_instance;
        }

        self::$_startTime = microtime(true);
        return self::$_instance = new FileAdapter(__DIR__.'/debug.log');
    }
}

LoggerTime::log('init');