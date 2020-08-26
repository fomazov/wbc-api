<?php

namespace WBC\Lib\Response;

use Phalcon\Mvc\User\Component;

class Basic extends Component
{
    const STATUS_ERROR = 'error';
    const STATUS_SUCCESS = 'success';

    const RESPONSE_CONTENT_TYPE = 'application/json';
    const RESPONSE_CHARSET = 'UTF-8';

    public function setJsonErrorResponse($result, $status = self::STATUS_ERROR)
    {
        return $this->setJsonResponse($result, $status);
    }

    public function setJsonResponse($result, $status = self::STATUS_SUCCESS)
    {
        $response = new \Phalcon\Http\Response();

        switch ($status) {
            case 'errorUnauthorized':
                $code = '401';
                $response->setStatusCode(401, "Unauthorized");
                $status = self::STATUS_ERROR;
                break;
            case 'errorPermissionDenied':
                $code = '403';
                $response->setStatusCode(403, "Permission Denied");
                $status = self::STATUS_ERROR;
                break;
            case 'errorWrongBranch':
                $code = '403';
                $response->setStatusCode(403, "Wrong Branch");
                $status = self::STATUS_ERROR;
                break;
            case 'errorNotFound':
                $code = '404';
                $response->setStatusCode(404, "Not Found");
                $status = self::STATUS_ERROR;
                break;
            case 'errorNotAllowed':
                $code = '405';
                $response->setStatusCode(405, "Not Allowed");
                $status = self::STATUS_ERROR;
                break;
            case 'error':
                $code = '400';
                $response->setStatusCode(400, "Bad Request");
                $status = self::STATUS_ERROR;
                break;
            case 'success':
                $code = '200';
                $response->setStatusCode(200, "Ok");
                $status = self::STATUS_SUCCESS;
                break;
            default:
                $code = '200';
                break;
        }

        $resp = array(
            'status' => $status,
            'code' => $code,
            'response' => $result
        );

        return $this->setSimpleJsonResponse($resp, $response);
    }

    public function setSimpleJsonResponse($data, $response = null)
    {
        if(!$response) {
            $response = new \Phalcon\Http\Response();
        }

        $response->setContentType(self::RESPONSE_CONTENT_TYPE, self::RESPONSE_CHARSET)
            ->setJsonContent($data, JSON_NUMERIC_CHECK | JSON_UNESCAPED_UNICODE);

        return $this->sendResponse($response);
    }

    public function setJsonNotFound()
    {
        $response = $this->setJsonResponse(array('message' => 'NotFound'), 'errorNotFound');
        return $this->sendResponse($response);
    }

    public function setJsonPermissionsDenied()
    {
        $response = $this->setJsonResponse(array('message' => _('error_permission_denied')), 'errorPermissionDenied');
        return $this->sendResponse($response);
    }

    private function sendResponse($response)
    {
        $response->send();
        exit;
    }
}