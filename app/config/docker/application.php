<?php
return array(
    "baseUrl" => "https://api-wbc.fomazov.name/",
    'clientUrl' => 'https://wbc.fomazov.name/',
    'database' => array(
        'adapter' => 'Mysql',
        'host' => 'v_wbc_api_db',
        'username' => 'vagrant',
        'password' => 'vagrant',
        'dbname' => 'wbc_api',
        'prefix' => 'wbc_'
    ),
    'dbHub' => array(
        'adapter' => 'Mysql',
        'host' => 'v_wbc_api_db',
        'username' => 'vagrant',
        'password' => 'vagrant',
        'dbname' => 'wbc_api'
    ),
    'mailgun' => array(
        'viewsDir' => APP_PATH . '/views/mail/',
        'domain' => 'mail-local.mrchub.com',
        'key' => 'key-d488eb0b976f1e4bdfe1cf6f6bf557b6',
        'from' => array(
            'name'  => 'Mail robot from WBC Demo Application',
            'email' => 'no-replay@wbc.fomazov.name'
        )
    )
);
