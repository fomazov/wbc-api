<?php

if(!defined('BASE_CONFIG')){
    define('BASE_CONFIG', sprintf('%s/base.php', __DIR__));
}

$baseConfig = require BASE_CONFIG;

$conf = 'docker';

if(!defined('ENV_CONFIG')){
    define('ENV_CONFIG', sprintf('%s/%s/application.php', __DIR__, $conf));
}

$config = array_merge($baseConfig, require ENV_CONFIG);

if(!class_exists('MainConfig')) {
    class MainConfig extends \Phalcon\Config
    {
        public function __toString()
        {
            return '';
        }
    }
}

return new MainConfig($config);