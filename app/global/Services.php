<?php

use Phalcon\Mvc\Url as UrlResolver;
use WBC\Lib\Pdo\Mysql as DbAdapter;
use WBC\Lib\Mailer\Main as Mailer;

use WBC\Lib\Acl\Access;
use WBC\Helpers\SingleSignOnHelper;

use WBC\Models\Client;
use WBC\Models\ClientEmail;
use WBC\Models\RegisterRequest;

use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Mvc\Model\Manager as ModelsManager;


$di->set('url', function ($param = null) use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri(rtrim($config['baseUrl'], '/'));
    return $param === null ? $url->getBaseUri() : $url->get( '/' . ltrim($param, '/'));
});

$di->set('envUrl', function($hub, $param = null) use ($config) {
    $url = rtrim($config[$hub], '/');
    return $param === null ? $url : $url . '/' . ltrim($param, '/');
});

$di->setShared('db', function () use ($config) {
    return new DbAdapter(array(
        "host" => $config->dbHub->host,
        "username" => $config->dbHub->username,
        "password" => $config->dbHub->password,
        "dbname" => $config->dbHub->dbname,
        "charset" => 'utf8'
    ));
});

$di->setShared('db2', function () use ($config) {
    return new DbAdapter(array(
        "host" => $config->dbDA->host,
        "username" => $config->dbDA->username,
        "password" => $config->dbDA->password,
        "dbname" => $config->dbDA->dbname,
        "charset" => 'utf8'
    ));
});

$di->setShared('dbXmpp', function () use ($config) {
    return new DbAdapter(array(
        "host" => $config->dbXmpp->host,
        "username" => $config->dbXmpp->username,
        "password" => $config->dbXmpp->password,
        "dbname" => $config->dbXmpp->dbname,
        "charset" => 'utf8'
    ));
});

$di->setShared('modelsMetadata', function () use ($config) {
    $config = array(
        'servers' => [
            [
                'host'   => 'v_memcached',
                'port'   => '11211',
                'weight' => 1,
            ],
        ],
        'prefix'   => 'ha',
    );

    $className = '\\Phalcon\\Mvc\\Model\\Metadata\\' . (class_exists('Memcached') ? 'Libmemcached' : 'Memcache');
    $metaData = new $className($config);

    return $metaData;
});

$di->setShared('modelsManager', function() {
    return new ModelsManager();
});

$di->setShared('security', function () {
    $security = new Phalcon\Security();
    $security->setWorkFactor(12);
    return $security;
});

$di->setShared('config', function() use ($config, $app){
    $isTest = false;
    try {
        $isTest = $app->request->getHeader('test');
        if($isTest){
            $config->database['prefix'] = 'test_';
        }
    } catch (\Exception $e) {

    }

    return $config;
});

$di->setShared('mailer', function () use ($config) {
    return new Mailer($config->mailgun->toArray());
});

$di->setShared('access', function () {
    return new Access();
});

$di->setShared('sso', function () use ($config, $di) {
    return new SingleSignOnHelper($config->brokers, $di);
});

$di->setShared('view', function () {
    $view = new SimpleView();
    $view->setViewsDir(BASE_PATH . '/app/views/');
    return $view;
});

$di->setShared('apiResponse', function(){
    return new WBC\Lib\Response\Basic();
});

$di->setShared('view', function () use ($config) {
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    $view->registerEngines(
        array(
            '.volt' => function ($view, $di)  use ($config) {
                $volt = new Volt($view, $di);

                $volt->setOptions(
                    array(
                        'compiledPath'      => $config->application->cacheDir . 'volt/',
                        'compiledSeparator' => '_',
                    )
                );
                $compiler = $volt->getCompiler();
                $compiler->addFunction('_', function($resolvedArgs, $exprArgs) {
                    return '_('.$resolvedArgs.')';
                });

                return $volt;
            }
        )
    );

    return $view;
});

$di->set('formatMessage', function($message, $vars = array()){
    return \WBC\Lib\Tools\Tools::formatMessage($message, $vars);
});

$di->set('handler', function () use ($config) {
    return new GitHubWebhook\Handler($config->gitwebhook->key, __DIR__);
});

$di->set('clientEmail', function($email){
    return ClientEmail::findFirstByEmail($email);
});

$di->set('clientById', function($id){
    return Client::findFirstById($id);
});

$di->set('registerRequest', function($email){
    return RegisterRequest::findFirstByEmail($email);
});