<?php

// This file has been created for usage
// predefined standard blocks of api description.

/**
 * @apiDefine DataNotFoundBaseError
 *
 * @apiError status Always "error"
 * @apiError code Status code
 * @apiError response Error name
 *
 * @apiErrorExample 401 Unauthorized
 *     HTTP/1.1 401 Unauthorized
 *     Only authenticated users can access the data.
 *     {
 *       "status": "error"
 *       "code": 401
 *       "response": "Unauthorized"
 *     }
 *
 * @apiErrorExample 403 Permission denied
 *     HTTP/1.1 403 Permission denied
 *     Not enough access rights.
 *     {
 *       "status": "error"
 *       "code": 403
 *       "response": "Permission denied"
 *     }
 *
 * @apiErrorExample 404 Not found
 *     HTTP/1.1 404 Not Found
 *     Data in request do not exist.
 *     {
 *       "status": "error"
 *       "code": 404
 *       "response": "NotFound"
 *     }
 *
 */

/**
 * @apiDefine ResponseOfSuccessBaseMessage
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response": ...
 *     }
 */

/**
 * @apiDefine parametersGet
 * @apiParam {String} Content-Type Content-Type
 * @apiParam {Number} id SSO broker Id (str)
 * @apiParam {String} secret SSO broker secret
 * @apiParam {String} token Client Token
 * @apiParam {String} locale Language
 */

/**
 * @apiDefine parametersPost
 * @apiParam {String} Content-Type Content-Type
 * @apiParam {Number} id SSO broker Id (str)
 * @apiParam {String} secret SSO broker secret
 * @apiParam {String} token Client Token
 * @apiParam {String} locale Language
 */

