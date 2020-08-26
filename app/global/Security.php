<?php

use \WBC\Models\Client as Client;

$app->before(function () use ($app, $di) {
    LoggerTime::log('Security:init');

    $ssoAllowRouters = array(
        '/attach'    => 1,
        '/login'     => 1,
        '/logout'    => 1,
        '/userinfo'  => 1,
        '/register'  => 1,
        '/password-reset/send' => 1,
        '/password-reset/check' => 1,
        '/password-reset' => 1
    );

    LoggerTime::log('Security:createResponse');
    $response  = new \Phalcon\Http\Response();
    $userToken = $app->request->getHeader('token');

    function errorResponse($response, $code, $msg)
    {
        $response->setStatusCode($code, $msg)
            ->setContentType('application/json')
            ->setJsonContent(array(
                'status' => 'error',
                'code' => $code,
                'response' => $msg
            ), JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE)
            ->send();
    }

    if(isset($ssoAllowRouters[rtrim($di->getRouter()->getRewriteUri(), '/')])) {
        if (!$userToken) {
            return true;
        } else {
            errorResponse($response, 401, _('token_not_needed'));
            return false;
        }
    }

    $brokerId     = $app->request->getHeader('id');
    $brokerSecret = $app->request->getHeader('secret');
    $ssoToken     = $app->request->getHeader('ssotoken');

    LoggerTime::log('Security:check acl');

    $brokersList = $app->config->brokers;

    if (!$brokerId || !$brokerSecret) {
        errorResponse($response, 401, _('broker_unauthorized'));
        return false;
    }

    LoggerTime::log('Security not isAllowed: has broker');

    if (!(isset($brokersList->{$brokerId})) || $brokersList->{$brokerId}->secret !== $brokerSecret) {
        errorResponse($response, 401, _('broker_unauthorizeds'));
        return false;
    }

    if(!$userToken) {
        //checked router by ACL
        return true;
    }

    $userInfo = false;
    if($ssoToken) {
        if(!$di->getSso()->checkSession($ssoToken)) {
            errorResponse($response, 401, _('user_unauthorized_expire_sso_token'));
            return false;
        }

        try {
            /**
             * @var $userInfo Client
             */
            $userInfo = $di->getSso()->checkUser();
            if(!$userInfo) {
                throw new \Exception('User not find');
            }
        } catch (\Exception $e) {
            errorResponse($response, 401, _('user_unauthorized_sso_session_not_find'));
            return false;
        }
    }

    LoggerTime::log('Security not isAllowed: findToken');
    $user = false;
    if(!$userInfo) {
        /**
         * @var $user Client
         */
        $user = \WBC\Models\Client::findFirstByToken($userToken);
    } elseif($userInfo && $userInfo->getToken() === $userToken)  {
        $user = $userInfo;
    }

    if (!$user) {
        errorResponse($response, 401, _('user_unauthorized_not_found_token'));
        return false;
    }

    $deletedAt = intval($user->getDeletedAt());
    if ($deletedAt != 0) {
        errorResponse($response, 401, _('user_unauthorized_user_deleted'));
        return false;
    }

    $role = $user->getUserType();
    $_SESSION['auth-role'] = $role;
    $di->set('currentUser', $user);
    return true;

});