<?php
defined('BASE_PATH') or define('BASE_PATH', dirname(dirname(dirname(__FILE__))));
defined('APP_PATH')  or define('APP_PATH', dirname(dirname(__FILE__)));

return array(
    'cache' => array(
        'aclForce' => false,
        'routerForce' => false,
    ),
    'application' => array(
        'controllersDir' => APP_PATH . '/controllers/',
        'modelsDir' => APP_PATH . '/models/',
        'helpersDir' => APP_PATH . '/helpers/',
        'cacheDir' => APP_PATH . '/cache/',
        'viewsDir' => APP_PATH . '/views/'
    ),
    'brokers' => array(
        'Client' => [ 'secret' => 'd41d8cd98f' ],
        'WebHook' => [ 'secret' => '92f61352b9' ],
    ),
    'namespaces' => array(

        // Vendor
        'Phalcon' => BASE_PATH . '/vendor/phalcon/incubator/Library/Phalcon',
        'Jasny\SSO' => BASE_PATH . '/vendor/jasny/sso/src',
        'Jasny' => BASE_PATH . '/vendor/jasny/validation-result/src',

        // WBC app
        'WBC' => APP_PATH,
        'WBC\Controllers' => APP_PATH . '/controllers',
        'WBC\Tasks' => APP_PATH . '/tasks',
        'WBC\Models' => APP_PATH . '/models',
        'WBC\Helpers' => APP_PATH . '/helpers',
        'WBC\Helpers\ValidationClass'  => APP_PATH . '/helpers/validation_class',
        'WBC\Helpers\ValidationErrors' => APP_PATH . '/helpers/validation_errors',
        'WBC\Lib' => APP_PATH . '/library'

    )

);