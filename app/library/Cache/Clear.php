<?php

namespace WBC\Lib\Cache;

use Phalcon\Mvc\User\Component;
use \RouterLoader;
use \StartApp;
use \Locale;

class Clear extends Component
{
    public static function all()
    {
        self::modelsMetadata();
        self::acl();
        self::router();
        self::locale();
    }

    public static function acl()
    {
        $self = new self();
        $access = $self->access;
        $access->clearAclData();
        $access->populateAclData();
    }

    public static function router()
    {
        if(CLI_APP) {
            $app = new \Phalcon\Mvc\Micro();
            $startApp = new StartApp();
            $startApp->setApp($app);
            $startApp->setRoutes();
        } else {
            global $app;
        }

        $router = new RouterLoader($app);
        $router->rebuild();
    }

    public static function modelsMetadata()
    {
        $self = new self();
        $di = $self->getDI();

        $modelNamespace = 'WBC\Models';
        $modelsDir = $di->get('config')->namespaces->{$modelNamespace};

        /*
         * @var $metaData \Phalcon\Mvc\Model\MetaData
         */
        $metaData = $di->get('modelsMetadata');

        $dirList  = scandir($modelsDir);
        $fileList = array_diff($dirList, array('..', '.', 'ApiModel.php'));

        $modelList = array();
        foreach ($fileList as $modelFile) {
            $modelName = '\\'.$modelNamespace.'\\'.str_replace('.php', '', $modelFile);
            $model = new $modelName();

            if($model instanceof \Phalcon\Mvc\Model) {
                $modelList[] = $model;
                $metaData->readMetaData(
                    $model
                );
            }
        }

        $metaData->reset();

        foreach ($modelList as $model) {
            $metadata = $model->getModelsMetaData();
            $metadata->getAttributes($model);
            $metadata->getDataTypes($model);
        }
    }

    public static function locale()
    {
        Locale::clearCache();
    }
}