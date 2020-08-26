<?php

namespace WBC\Controllers;

use \WBC\Helpers\CacheHelper;

abstract class ApiController extends \Phalcon\Mvc\Controller
{
    use CacheHelper;

    const STATUS_ERROR = 'error';
    const STATUS_SUCCESS = 'success';
    const RESULT_MESSAGE_KEY = 'message';

    public static function __callStatic($name, $arguments) {
        $name = str_replace('checkAclEndCall_', '', $name);

        $ctrl = new static();

        if(!method_exists($ctrl, $name)) {
            return $ctrl->getDI()->getApiResponse()->setJsonNotFound();
        }

        $ctrlName = substr(strrchr(get_class($ctrl), "\\"), 1);
        if(!$ctrl->getDi()->getAccess()->isAllowed($ctrlName, $name)) {
            return $ctrl->getDI()->getApiResponse()->setJsonResponse(_('permission_ctrl_denied'), 'errorPermissionDenied');
        }

        $checkList = $ctrl->checkAllow();
        if(isset($checkList[$name])) {
            $result = $checkList[$name];
            if(($result instanceof \Closure && !$result()) || is_bool($result) && $result) {
                return $ctrl->getDI()->getApiResponse()->setJsonResponse(_('permission_action_denied'), 'errorPermissionDenied');
            }
        }

        return call_user_func_array(array($ctrl, $name), $arguments);
    }

    protected function checkAllow()
    {
        return [];
    }

    public function setJsonErrorResponse($result, $status = self::STATUS_ERROR)
    {
        return $this->getDI()->getApiResponse()->setJsonResponse($result, $status);
    }

    public function setJsonResponse($result, $status = self::STATUS_SUCCESS)
    {
        return $this->getDI()->getApiResponse()->setJsonResponse($result, $status);
    }

    public function setSimpleJsonResponse($data, $response = null)
    {
        return $this->getDI()->getApiResponse()->setSimpleJsonResponse($data, $response);
    }

    public function setJsonNotFound()
    {
        return $this->getDI()->getApiResponse()->setJsonNotFound();
    }

    public function setJsonPermissionsDenied()
    {
        return $this->getDI()->getApiResponse()->setJsonPermissionsDenied();
    }

    protected function getRequestData()
    {
        return $this->request->getJsonRawBody();
    }

    public function isAllow($action, $params)
    {
        return false;
    }

    protected function getSendSuccessOkMessage()
    {
        $result = array(self::RESULT_MESSAGE_KEY => 'ok');
        return $this->setJsonResponse($result);
    }

    protected function getSendErrorTextMessage($text)
    {
        $result[self::RESULT_MESSAGE_KEY][] = $text;
        return $this->setJsonErrorResponse($result);
    }
}
