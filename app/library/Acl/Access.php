<?php

namespace WBC\Lib\Acl;

use Phalcon\Mvc\User\Component,
    \Phalcon\Acl,
    \LoggerTime;

use WBC\Lib\Acl\Adapter\Database as AclDb;

class Access extends Component
{
    public $acl;
    public $roles;
    public $privateResources = [];

    public function __construct()
    {
        LoggerTime::log('Access:__construct');

        $this->acl = new AclDb(
            [
                'db' => $this->db,
                'roles' => $this->config->database['prefix'] . 'acl_role',
                'rolesInherits' => $this->config->database['prefix'] . 'acl_role_inherit',
                'resources' => $this->config->database['prefix'] . 'acl_resource',
                'resourcesAccesses' => $this->config->database['prefix'] . 'acl_resource_access',
                'accessList' => $this->config->database['prefix'] . 'acl_access_list'
            ]
        );

        LoggerTime::log('Access:initDB');

        $this->acl->setDefaultAction(\Phalcon\Acl::DENY);

        LoggerTime::log('Access:set default action');

        if ($this->config->cache->aclForce) {
            $this->populateAclData();
        }

        LoggerTime::log('Access:END');
    }

    public function populateAclData()
    {
        LoggerTime::log('Access:populateAclData');

        //Register roles
        $allowList = include CONFIG_PATH . '/acl_allow_list.php';

        LoggerTime::log('Access:populateAclData: load roles');

        $this->roles = $this->privateResources = [];
        foreach ($allowList as $key => $value) {
            $this->roles[] = $key;
            $this->acl->addRole(new \Phalcon\Acl\Role($key));

            // Private Resource
            foreach ($value as $k => $v) {
                if (array_key_exists($k, $this->privateResources)) {
                    $this->privateResources[$k] = array_merge($this->privateResources[$k], $v);
                } else {
                    $this->privateResources[$k] = $v;
                }
                $this->privateResources[$k] = array_unique($this->privateResources[$k]);

                $this->acl->addResource(new \Phalcon\Acl\Resource($k), $v);
            }

            // List Actions and Allow
            foreach ($this->privateResources as $k => $v) {
                $this->acl->allow($key, $k, $v);
            }
        }

        LoggerTime::log('Access:populateAclData:END');
    }

    public function clearAclData()
    {
        $this->acl->clearAllData();
    }

    public function isAllowed($resource, $action)
    {
        LoggerTime::log('Access:isAllowed:start');

        $role = 'utGuest';
        if ($this->di->has('currentUser')) {
            LoggerTime::log('Access:isAllowed:has DI User');
            $role = $this->di->get('currentUser')->getUserType();
            LoggerTime::log('Access:isAllowed:get DI User role');
        } else {
            if (isset($_SESSION['auth-role'])) {
                $role = $_SESSION['auth-role'];
                unset($_SESSION['auth-role']);
            }
        }

        LoggerTime::log('Access:isAllowed:check by role, resource and action');
        return $this->acl->isAllowed($role, $resource, $action);
    }
}