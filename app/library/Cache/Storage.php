<?php

namespace WBC\Lib\Cache;

use Phalcon\Mvc\User\Component;

class Storage extends Component
{
    public $type = false;
    private static $self = false;

    private function __construct()
    {
        $typesList = array(
            'Memcache' => class_exists('Memcache'),
            'Apc'      => function_exists('apc_store') && function_exists('apc_fetch')
        );

        foreach ($typesList as $typeName => $isAllow) {
            if(!$isAllow) {
                continue;
            }

            $className = '\\WBC\\Lib\\Cache\\StorageType\\'.$typeName;
            $this->type = new $className();
            break;
        }
    }

    protected static function getSelf()
    {
        if(self::$self) {
            return self::$self;
        }

        return self::$self = new self();
    }

    public static function isAllow()
    {
        $self = self::getSelf();
        return !!$self->type;
    }

    public static function get($key)
    {
        if(!self::isAllow()) {
            return false;
        }

        $self = self::getSelf();
        return $self->type->get($key);
    }

    public static function set($key, $data)
    {
        if(!self::isAllow()) {
            return false;
        }

        $self = self::getSelf();
        $self->type->set($key, $data);
    }
}