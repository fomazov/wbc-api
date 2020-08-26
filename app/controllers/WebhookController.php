<?php

namespace WBC\Controllers;

use \RouterLoader;
use WBC\Lib\Cache\Clear as ClearCache;

class WebhookController extends ApiController
{

    public function aclRewrite()
    {
        ClearCache::acl();
        return $this->setJsonResponse(['ok'], 'success');
    }

    public function routeRewrite()
    {
        ClearCache::router();
        return $this->setJsonResponse(['ok'], 'success');
    }

}