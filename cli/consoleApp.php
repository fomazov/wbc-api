<?php

class ConsoleApp extends StartApp
{
    protected function setNotFound()
    {

    }

    protected function setSecurity()
    {

    }

    public function setRoutes()
    {
        $this->getDi()->setShared('router', function() {
            return new Phalcon\CLI\Router();
        });

        $this->getDi()->setShared('dispatcher', function() {
            $dispatcher = new Phalcon\CLI\Dispatcher();
            $dispatcher->setDefaultNamespace('\\WBC\\Tasks');
            return $dispatcher;
        });

        $this->getDi()->setShared('console', $this->getApp());
    }

    protected function initDI()
    {
        $this->di = new \Phalcon\DI\FactoryDefault\CLI();
    }

    public function init()
    {
        $this->initDI();
        $this->setNotFound();
        $this->setEnv();
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
        $this->getApp()->handle($this->parseParams());
    }

    protected function parseParams()
    {
        global $argv;

        $task = 'main';
        $action = 'main';

        // Parse command line parameters "cli/index.php taskName/actionName param1=value1 param2=value2"
        $handle_params = array();
        array_shift($argv); // Skip "cli/index.php"

        if(count($argv)) {
            list($task, $action) = explode('/', array_shift($argv)); // Parse "taskName/actionName"
            foreach ($argv as $param) {
                list($name, $value) = explode('=', $param);
                $handle_params[$name] = $value;
            }
        }

        $handle_params['task']   = '\\WBC\\Tasks\\'.ucfirst($task).'Task';
        $handle_params['task']   = ucfirst($task);
        $handle_params['action'] = $action;

        return $handle_params;
    }

    protected function setEnv()
    {
        global $argv;
        $argvLocal = $argv;
        $allowedEnvs = [
            'local',
            'test',
            'test_dev_rel',
            'development',
            'production',
        ];
        array_shift($argvLocal); // Skip "cli/index.php"
        array_shift($argvLocal); // Skip "taskName/actionName"
        foreach ($argvLocal as $param) {
            list($key, $value) = explode('=', $param);
            if ($key === 'env'){
                if (!in_array($value, $allowedEnvs)){
                    die("Error! Unknown environment. Allowed: " . implode(", ", $allowedEnvs));
                }
            }
        }

    }
}