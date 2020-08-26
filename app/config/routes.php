<?php

if (!defined('ROUTES_PATH')) {
    throw new \Exception('ROUTES_PATH is not defined');
}

use WBC\Lib\Cache\Storage as StorageCache;

class RouterLoader
{
    private $app = false;
    private $allow_store = false;
    private $store_name = 'routers';

    private $respMethod = array(
        'getAll' => 'get',
        'getById' => 'get',
        'deleteById' => 'delete',
        'updateById' => 'put',
        'add' => 'post',
        'options' => 'options'
    );

    public function __construct($app)
    {
        $this->app = $app;

        $routersList = null;
        $this->allow_store = StorageCache::isAllow();
        if($this->allow_store) {
            $this->store_name .= '_docker';

            $routersList = StorageCache::get($this->store_name);
        }

        return $this->getData($routersList);
    }

    public function rebuild()
    {
        \LoggerTime::log('router:start:rebuild');
        $directory  = new RecursiveDirectoryIterator(ROUTES_PATH);
        $iterator   = new RecursiveIteratorIterator($directory);
        $routeFiles = new RegexIterator($iterator, '/^.+\.php$/i', RegexIterator::GET_MATCH);

        $routersList = $this->loadRouters($routeFiles);
        if($this->allow_store) {
            StorageCache::set($this->store_name, $routersList);
        }
        return $routersList;
    }

    private function getData($routersList)
    {
        if (!is_array($routersList) || $this->app->config->cache->routerForce) {
            $routersList = $this->rebuild();
        }

        if (!is_array($routersList)) {
            return false;
        }

        foreach($routersList as $route => $itemRouters) {
            if(!is_array($itemRouters)) {
                continue;
            }

            $this->addRouterHandler($itemRouters, $route);
        }
        return false;
    }

    private function loadRouters($routeFiles)
    {
        $routers = array();
        foreach ($routeFiles as $routeContent) {
            $routerFile = $routeContent[0];
            $route = str_replace(array(ROUTES_PATH.DIRECTORY_SEPARATOR, '.php'), '', $routeContent[0]);

            if ($route == 'PreDefinedApiDoc') {
                continue;
            }

            $itemRouters = include_once($routerFile);
            if(!$itemRouters || !is_array($itemRouters)) {
                continue;
            }

            $routers[$route] = $itemRouters;
            \LoggerTime::log('router:include:'.$route);
        }
        return $routers;
    }

    private function addRouterHandler($itemRouters, $route)
    {
        \LoggerTime::log('router:addRouterHandler:'.$route);

        $controller = 'WBC\\Controllers\\' . ucfirst($route) . 'Controller';
        foreach($itemRouters as $method) {
            $requestType = $method[1];
            $requestRoute = $method[0];
            $action = isset($method[2]) ? $method[2] : false;

            if (isset($this->respMethod[$requestType])) {
                $action = $requestType;
                $requestType = $this->respMethod[$requestType];
            }

            $this->app->{$requestType}($requestRoute, $controller.'::checkAclEndCall_'.$action);
        }

        \LoggerTime::log('router:addRouterHandler:END');
    }
}

$router = new RouterLoader($app);

\LoggerTime::log('router:after_add');