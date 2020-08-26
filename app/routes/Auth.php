<?php

return array(
    array('/attach', 'get', 'attach'),
    array('/attach', 'post', 'attach'),
    array('/login', 'post', 'login'),
    array('/logout', 'post', 'logout'),
    array('/userinfo', 'get', 'userInfo'),
    array('/register', 'post', 'registerUser'),
    array('/password-reset/send', 'post', 'pwdResetSend'),
    array('/password-reset/check', 'post', 'pwdResetCheck'),
    array('/password-reset', 'post', 'pwdReset'),

    array('/activate/{code:[a-zA-Z0-9]+}', 'get', 'activateUser'),
    array('/activate-login/{code:[a-zA-Z0-9]+}', 'get', 'activateLoginUser'),
    array('/activate-email/{code:[a-zA-Z0-9]+}/{email:[a-zA-Z0-9@\-_\.]+}', 'get', 'activateEmailUser'),

    array('/auth/check', 'get', 'checkOk')
);

/**
 * @api {get} /attach Attach SSO get
 * @apiVersion 0.1.0
 * @apiName Attach SSO - get
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X GET 'https://api-wbc.fomazov.name/attach?command=attach&broker=%broker_name%&token=%sso_token%'
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *      {
 *          "success":"attached"
 *      }
 *
 * @apiSuccessExample 200 Success
 *      image from base64
 * 
 * @apiErrorExample 400 Bad Request
 *      {
 *          "error":"No broker specified"
 *      }
 */

/**
 * @api {post} /attach Attach SSO post
 * @apiVersion 0.1.0
 * @apiName Attach SSO - post
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X POST 'https://api-wbc.fomazov.name/attach' -H 'Content-Type : application/x-www-form-urlencoded' -H 'broker : %broker_id%' -H 'token : %sso_token%'
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *      {
 *          "success":"attached"
 *      }
 *
 * @apiSuccessExample 200 Success
 *      image from base64
 *
 * @apiErrorExample 400 Bad Request
 *      {
 *          "error":"No broker specified"
 *      }
 */

/**
 * @api {get} /userinfo User Info
 * @apiVersion 0.1.0
 * @apiName userInfo
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X GET 'https://api-wbc.fomazov.name/userinfo' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response":
 *          {
 *              "id":
 *              "area":
 *              "auth_hash":
 *              "author_id":
 *              "client_status":
 *              "default_locale":
 *              "first_name":
 *              "second_name":
 *              "last_name":
 *              "first_name_ru":
 *              "second_name_ru":
 *              "last_name_ru":
 *              "password":
 *              "token":
 *              "is_hidden":
 *              "is_players_valid":
 *              "region":
 *              "timezone":
 *              "user_type":
 *              "expired_date":
 *              "created_at":
 *              "updated_at":
 *          }
 *     }
 *
 * @apiErrorExample 401 Error
 *     HTTP/1.1 401 Error
 *     {
 *       "status": "error"
 *       "code": 401
 *       "response": null
 *     }
 */

/**
 * @api {post} /login Login
 * @apiVersion 0.1.0
 * @apiName auth
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X GET 'https://api-wbc.fomazov.name/login' -d 'username=sample@test.com' -d 'password=pwd' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%'
 *
 * @apiParam {String} username User E-Mail
 * @apiParam {String} password User password
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response":
 *          {
 *              "id":
 *              "crm_id":
 *              "area":
 *              "auth_hash":
 *              "author_id":
 *              "client_status":
 *              "company_id":
 *              "default_locale":
 *              "first_name":
 *              "second_name":
 *              "last_name":
 *              "first_name_ru":
 *              "second_name_ru":
 *              "last_name_ru":
 *              "password":
 *              "token":
 *              "detalisation":
 *              "is_company_admin":
 *              "is_hidden":
 *              "is_players_valid":
 *              "private_key":
 *              "private_like_count":
 *              "public_key":
 *              "public_like_count":
 *              "region":
 *              "timezone":
 *              "user_type":
 *              "expired_date":
 *              "created_at":
 *              "updated_at":
 *              "da_id":
 *          }
 *     }
 *
 * @apiError status Always "error"
 * @apiError code Status code
 * @apiError response Error name
 *
 *
 * @apiErrorExample 400 Bad Request
 *     {
 *          "error": "No username specified"
 *     }
 *
 * @apiErrorExample 400 Bad Request
 *     {
 *          "error": "Invalid credentials"
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
 * @api {post} /logout Logout
 * @apiVersion 0.1.0
 * @apiName Logout
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X POST 'https://api-wbc.fomazov.name/logout' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%'
 *
 *
 */

/**
 * @api {post} /register Register User
 * @apiVersion 0.1.0
 * @apiName registerUser
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X POST 'https://api-wbc.fomazov.name/register' -d 'email=sample@test.com' -d 'password=pwd'  -d 'first_name=%user_first_name%'  -d 'last_name=%user_last_name%' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%
 *
 * @apiParam {String} email User E-Mail
 * @apiParam {String} password User password
 * @apiParam {String} first_name User first name
 * @apiParam {String} last_name User last name
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response":
 *          {
 *             "id":
 *             "code":
 *             "email":
 *             "password":
 *             "first_name":
 *             "last_name":
 *             "created_at":
 *             "updated_at":
 *          }
 *     }
 *
 * @apiError status Always "error"
 * @apiError code Status code
 * @apiError response Error name
 *
 * @apiErrorExample 401 Error
 *  {
 *      "status": "error"
 *      "code": 401
 *      "response": {
 *          "message": {
 *              "email": "email is required"
 *              "password": "Поле 'пароль' обязательно для заполнения"
 *              "first_name": "Поле 'имя' обязательно для заполнения"
 *              "last_name": "Поле 'фамилия' обязательно для заполнения"
 *          }
 *      }
 *  }
 */


/**
 * @api {get} /activate/{code:[a-zA-Z0-9]+} Activate User
 * @apiVersion 0.1.0
 * @apiName activateUser
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X GET 'https://api-wbc.fomazov.name/activate/123abc' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'
 *
 * @apiParam {String} code Activation code
 *
 */

/**
 * @api {get} /activate-login/{code:[a-zA-Z0-9]+} Activate User Login
 * @apiVersion 0.1.0
 * @apiName activateLoginUser
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X GET 'https://api-wbc.fomazov.name/activate-login/123abc' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'
 *
 * @apiParam {String} code Activation code
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response":
 *          {
 *              "id":
 *              "crm_id":
 *              "area":
 *              "auth_hash":
 *              "author_id":
 *              "client_status":
 *              "company_id":
 *              "default_locale":
 *              "first_name":
 *              "second_name":
 *              "last_name":
 *              "first_name_ru":
 *              "second_name_ru":
 *              "last_name_ru":
 *              "password":
 *              "token":
 *              "detalisation":
 *              "is_company_admin":
 *              "is_hidden":
 *              "is_players_valid":
 *              "private_key":
 *              "private_like_count":
 *              "public_key":
 *              "public_like_count":
 *              "region":
 *              "timezone":
 *              "user_type":
 *              "expired_date":
 *              "created_at":
 *              "updated_at":
 *              "da_id":
 *          }
 *     }
 *
 * @apiErrorExample 400 Bad Request
 *     {
 *          "error": "Неверный активационный код"
 *     }
 * @apiErrorExample 400 Bad Request
 *     {
 *          "error": "Пользователь не найден"
 *     }
 * @apiErrorExample 400 Bad Request
 *     {
 *          "error": "Email не найден"
 *     }
 *
 */

/**
 * @api {post} /password-reset/send Send request to reset password
 * @apiVersion 0.1.0
 * @apiName pwdResetSend
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X POST 'https://api-wbc.fomazov.name/password-reset/send' -d 'email=sample@test.com' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%
 *
 * @apiParam {String} email User E-Mail
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response": {
 *          "message":[
 *              "На указанную Вами почту выслано письмо для подтверждения смены пароля"
 *          ]
 *       }
 *     }
 *
 * @apiError status Always "error"
 * @apiError code Status code
 * @apiError response Error name
 *
 * @apiErrorExample 401 Error
 *  {
 *      "status": "error"
 *      "code": 401
 *      "response": {
 *          "message":[
 *              "Email не найден"
 *          ]
 *       }
 *  }
 */

/**
 * @api {post} /password-reset/check Send request to reset password
 * @apiVersion 0.1.0
 * @apiName pwdResetCheck
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X POST 'https://api-wbc.fomazov.name/password-reset/check' -d 'code=000000000' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%
 *
 * @apiParam {String} code reset code
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response": {
 *          "message":["ok"]
 *       }
 *     }
 *
 * @apiError status Always "error"
 * @apiError code Status code
 * @apiError response Error name
 *
 * @apiErrorExample 401 Error
 *  {
 *      "status": "error"
 *      "code": 401
 *      "response": {
 *          "message":[
 *              "Код смены пароля не найден или устарел"
 *          ]
 *       }
 *  }
 */

/**
 * @api {post} /password-reset Change password after reset request
 * @apiVersion 0.1.0
 * @apiName pwdReset
 * @apiGroup Auth
 * @apiPermission utGuest
 * @apiSampleRequest off
 *
 * @apiExample Example usage:
 * /usr/bin/curl -X POST 'https://api-wbc.fomazov.name/password-reset' -d 'code=000000000' -d 'password=123456789' -d 'password_repeat=123456789' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%
 *
 * @apiParam {String} code reset code
 * @apiParam {String} password reset new password
 * @apiParam {String} password_repeat password repeat
 *
 * @apiSuccessExample 200 Success
 *     HTTP/1.1 200 Success
 *     {
 *       "status": "success"
 *       "code": 200
 *       "response": {"email":"codecept_test_3@custom.com"}
 *     }
 *
 * @apiError status Always "error"
 * @apiError code Status code
 * @apiError response Error name
 *
 * @apiErrorExample 401 Error
 *  {
 *      "status": "error"
 *      "code": 401
 *      "response": {
 *          "message":[
 *              "Код смены пароля не найден или устарел",
 *              "Необходимо повторно указать пароль",
 *              "Пароли не совпадают"
 *          ]
 *       }
 *  }
 */