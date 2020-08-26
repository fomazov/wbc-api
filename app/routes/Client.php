<?php

require_once __DIR__ . '/PreDefinedApiDoc.php';

return array(
    array('/clients/getByCurrentToken', 'get', 'getByCurrentToken'),
    array('/clients/getByIds/{ids:[0-9,]+}', 'get', 'getByIds'),
    array('/clients/getByNameInIds', 'post', 'getByNameInIds'),
);

/**
 * @api {get} /clients/getByCurrentToken Read client by current token
 * @apiVersion 0.1.0
 * @apiName getByCurrentToken
 * @apiGroup Client
 * @apiPermission utUser
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X GET 'https://api-wbc.fomazov.name/clients/getByCurrentToken' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'
 *
 * @apiUse parametersGet
 *
 * @apiSuccess {Number}   id              The User ID.
 * @apiSuccess {String}   email           User E-Mail address.
 * @apiSuccess {String}   firstName       FirstName of the User.
 * @apiSuccess {String}   lastName        LastName of the User.
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response": {
 *              "id": 105,
 *              "firstName": "first name",
 *              "lastName": "last name",
 *              "firstNameRu": "first name",
 *              "lastNameRu": "last name",
 *              "userType": "utVerifiedUser",
 *              "companyId": 0,
 *              "online": false,
 *        }
 *     }
 *
 * @apiUse DataNotFoundBaseError
 */

/**
 * @api {get} /clients/getByIds/{ids:[0-9,]+}   Get list of client by id list
 * @apiVersion 0.1.0
 * @apiName getByIds
 * @apiGroup Client
 * @apiPermission utUser
 * @apiSampleRequest off
 *
 * @apiParam {String} ids      list of ids, coma separated
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X GET 'https://api-wbc.fomazov.name/clients/getByIds/1,2,3' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'
 *
 * @apiUse parametersGet
 *
 * @apiSuccess {Number}   id              The User ID.
 * @apiSuccess {String}   email           User E-Mail address.
 * @apiSuccess {String}   firstName       FirstName of the User.
 * @apiSuccess {String}   lastName        LastName of the User.
 *
 * @apiSuccessExample 200 Success
 *      HTTP/1.1 200 Success
 *      {
 *          "status": "success"
 *          "code": 200
 *          "response": [
 *              {
 *                  "id": 105,
 *                  "firstName": "first name",
 *                  "lastName": "last name",
 *                  "firstNameRu": "first name",
 *                  "lastNameRu": "last name",
 *                  "userType": "utUser",
 *                  "online": false,
 *              },
 *              ...
 *          ]
 *      }
 *
 * @apiUse DataNotFoundBaseError
 */

/**
 * @api {post} /clients/getByNameInIds   Get list of client by name and id list
 * @apiVersion 0.1.0
 * @apiName getByNameInIds
 * @apiGroup Client
 * @apiPermission utUser
 * @apiSampleRequest off
 *
 * @apiParam {String} name      part of name
 * @apiParam {Array} ids        array of ids
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X POST 'https://api-wbc.fomazov.name/clients/getByNameInIds' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'
 *
 * @apiUse parametersGet
 *
 * @apiSuccess {Number}   id              The User ID.
 * @apiSuccess {String}   email           User E-Mail address.
 * @apiSuccess {String}   firstName       FirstName of the User.
 * @apiSuccess {String}   lastName        LastName of the User.
 *
 * @apiSuccessExample 200 Success
 *      HTTP/1.1 200 Success
 *      {
 *          "status": "success"
 *          "code": 200
 *          "response": [
 *              {
 *                  "id": 105,
 *                  "firstName": "first name",
 *                  "lastName": "last name",
 *                  "firstNameRu": "first name",
 *                  "lastNameRu": "last name",
 *                  "userType": "utVdUser",
 *                  "companyId": 0,
 *                  "lastVisit": "2019-12-22 12:24:51",
 *                  "online": false,
 *              },
 *              ...
 *          ]
 *      }
 *
 * @apiUse DataNotFoundBaseError
 */