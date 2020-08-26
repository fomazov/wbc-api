<?php

defined('CLI_APP') or define('CLI_APP', false);
define('BASE_PATH', realpath(__DIR__ . '/..'));
define('APP_PATH' , BASE_PATH . '/app');

define('TEMP_PATH', BASE_PATH . '/public/temp');
define('UPLOADS_PATH', BASE_PATH . '/public/uploads');

define('NODE_MODULES_PATH', BASE_PATH . '/node_modules');
define('CONFIG_PATH', APP_PATH . '/config');
define('ROUTES_PATH', APP_PATH . '/routes');

include_once APP_PATH . '/library/Logger/LoggerTime.php';

include APP_PATH . '/global/Locale.php';
LoggerTime::log('after locale');
include APP_PATH . '/global/ExceptionThrower.php';
LoggerTime::log('after exception');

function exceptionResponse( $app, $e,
                            $code, $msg ) {
    $traceArray = $e->getTrace();

    $app->response
        ->setContentType('application/json')
        ->setStatusCode($code, $msg)
        ->setJsonContent([
            'status' => $msg,
            'code' => $code,
            'response' => array(
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $traceArray
            )
        ], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);

    $app->response->send();
}
LoggerTime::log('after exception response');

ExceptionThrower::Start();

LoggerTime::log('after exception start');

include BASE_PATH . '/vendor/autoload.php';
LoggerTime::log('autoload');

class StartApp
{
    protected $app;
    protected $di;

    /**
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * @param mixed $app
     */
    public function setApp($app)
    {
        $this->app = $app;
    }

    public function init()
    {
        $this->initDI();
        $this->setNotFound();
        $this->setIncludes();
    }

    public function start()
    {
        $this->init();
        $this->run();
        LoggerTime::log('app handle');
    }

    protected function run()
    {
        $this->getApp()->handle();
    }

    protected function initDI()
    {
        $this->di = new \Phalcon\DI\FactoryDefault();
    }

    protected function getDI()
    {
        return $this->di;
    }

    protected function setNotFound()
    {
        LoggerTime::log('new app');
        $app = $this->getApp();
        $app->notFound(function () use ($app) {
            $app->response
                ->setContentType('application/json')
                ->setStatusCode(404, "Not Found")
                ->setJsonContent([
                    'status' => 'error',
                    'code' => 404,
                    'response' => array(
                        'message' => 'Not Found'
                    )
                ], JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);

            return $app->response;
        });
    }

    protected function setLoader($config)
    {
        $app = $this->getApp();
        $di = $this->getDI();

        include APP_PATH . '/global/Loader.php';
        LoggerTime::log('app set loader');
    }

    protected function setSecurity()
    {
        $app = $this->getApp();
        $di = $this->getDI();

        include APP_PATH . '/global/Security.php';
        LoggerTime::log('app set Security');
    }

    public function setRoutes()
    {
        $app = $this->getApp();

        include CONFIG_PATH . '/routes.php';
        LoggerTime::log('app set routes');
    }

    public function setDBProfiler()
    {
        $eventsManager = new \Phalcon\Events\Manager();
        $logger        = new \WBC\Lib\Logger\DB();
        $profiler      = new Phalcon\Db\Profiler();

        /** @var $event \Phalcon\Events\Event */
        /** @var $phalconConnection \Phalcon\Db\Adapter\Pdo\Mysql */

        $eventsManager->attach('db', function($event, $phalconConnection) use ($logger, $profiler) {
            if ($event->getType() == 'beforeQuery') {
                $profiler->startProfile($phalconConnection->getSQLStatement());

                $statement = $phalconConnection->getSQLStatement();
                $variables = $phalconConnection->getSQLVariables();

                if($variables) {
                    foreach ($variables as $k => $v) {
                        if(is_array($v)) {
                            $v = implode(',', $v);
                        }
                        $statement = preg_replace('/:' . $k . '/', '\'' . $v . '\'$1', $statement);
                    }
                }

                $traceList = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
                $traceList = array_filter($traceList, function($item){
                    return isset($item['file']);
                });

                $traceList = array_map(function($item){
                    unset($item['type']);
                    unset($item['class']);
                    return $item;
                }, $traceList);

                $traceList = array_values($traceList);
                $logger->log($statement, \Phalcon\Logger::INFO, array(
                    'sql' => $phalconConnection->getSQLStatement(),
                    'var' => $variables,
                    'trace' => array_values($traceList)
                ));
            }
            if ($event->getType() == 'afterQuery') {
                $profiler->stopProfile();
            }
        });

        /** @var $phalconConnection \Phalcon\Db\Adapter\Pdo\Mysql */
        $connection = $this->getDI()->get('db');
        $connection->setEventsManager($eventsManager);
    }

    protected function setIncludes()
    {
        $di = $this->getDI();
        $app = $this->getApp();

        $config = include APP_PATH . '/config/config.php';
        LoggerTime::log('app set config');

        include APP_PATH . '/global/Services.php';
        LoggerTime::log('app set services');

        $this->setLoader($config);

        $app->setDi($di);
        LoggerTime::log('app set DI');

        //$this->setDBProfiler();
        $this->setSecurity();
        $this->setRoutes();
    }
}