define({ "api": [
  {
    "type": "get",
    "url": "/attach",
    "title": "Attach SSO get",
    "version": "0.1.0",
    "name": "Attach_SSO___get",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X GET 'https://api-wbc.fomazov.name/attach?command=attach&broker=%broker_name%&token=%sso_token%'",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n {\n     \"success\":\"attached\"\n }",
          "type": "json"
        },
        {
          "title": "200 Success",
          "content": "image from base64",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "400 Bad Request",
          "content": "{\n    \"error\":\"No broker specified\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/attach",
    "title": "Attach SSO post",
    "version": "0.1.0",
    "name": "Attach_SSO___post",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X POST 'https://api-wbc.fomazov.name/attach' -H 'Content-Type : application/x-www-form-urlencoded' -H 'broker : %broker_id%' -H 'token : %sso_token%'",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n {\n     \"success\":\"attached\"\n }",
          "type": "json"
        },
        {
          "title": "200 Success",
          "content": "image from base64",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "400 Bad Request",
          "content": "{\n    \"error\":\"No broker specified\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/logout",
    "title": "Logout",
    "version": "0.1.0",
    "name": "Logout",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X POST 'https://api-wbc.fomazov.name/logout' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%'",
        "type": "json"
      }
    ],
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "get",
    "url": "/activate-login/{code:[a-zA-Z0-9]+}",
    "title": "Activate User Login",
    "version": "0.1.0",
    "name": "activateLoginUser",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X GET 'https://api-wbc.fomazov.name/activate-login/123abc' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Activation code</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n  \"status\": \"success\"\n  \"code\": 200\n  \"response\":\n     {\n         \"id\":\n         \"crm_id\":\n         \"area\":\n         \"auth_hash\":\n         \"author_id\":\n         \"client_status\":\n         \"company_id\":\n         \"default_locale\":\n         \"first_name\":\n         \"second_name\":\n         \"last_name\":\n         \"first_name_ru\":\n         \"second_name_ru\":\n         \"last_name_ru\":\n         \"password\":\n         \"token\":\n         \"detalisation\":\n         \"is_company_admin\":\n         \"is_hidden\":\n         \"is_players_valid\":\n         \"private_key\":\n         \"private_like_count\":\n         \"public_key\":\n         \"public_like_count\":\n         \"region\":\n         \"timezone\":\n         \"user_type\":\n         \"expired_date\":\n         \"created_at\":\n         \"updated_at\":\n         \"da_id\":\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "400 Bad Request",
          "content": "{\n     \"error\": \"???????????????? ?????????????????????????? ??????\"\n}",
          "type": "json"
        },
        {
          "title": "400 Bad Request",
          "content": "{\n     \"error\": \"???????????????????????? ???? ????????????\"\n}",
          "type": "json"
        },
        {
          "title": "400 Bad Request",
          "content": "{\n     \"error\": \"Email ???? ????????????\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "get",
    "url": "/activate/{code:[a-zA-Z0-9]+}",
    "title": "Activate User",
    "version": "0.1.0",
    "name": "activateUser",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X GET 'https://api-wbc.fomazov.name/activate/123abc' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Activation code</p>"
          }
        ]
      }
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/login",
    "title": "Login",
    "version": "0.1.0",
    "name": "auth",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X GET 'https://api-wbc.fomazov.name/login' -d 'username=sample@test.com' -d 'password=pwd' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%'",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>User E-Mail</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>User password</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n  \"status\": \"success\"\n  \"code\": 200\n  \"response\":\n     {\n         \"id\":\n         \"crm_id\":\n         \"area\":\n         \"auth_hash\":\n         \"author_id\":\n         \"client_status\":\n         \"company_id\":\n         \"default_locale\":\n         \"first_name\":\n         \"second_name\":\n         \"last_name\":\n         \"first_name_ru\":\n         \"second_name_ru\":\n         \"last_name_ru\":\n         \"password\":\n         \"token\":\n         \"detalisation\":\n         \"is_company_admin\":\n         \"is_hidden\":\n         \"is_players_valid\":\n         \"private_key\":\n         \"private_like_count\":\n         \"public_key\":\n         \"public_like_count\":\n         \"region\":\n         \"timezone\":\n         \"user_type\":\n         \"expired_date\":\n         \"created_at\":\n         \"updated_at\":\n         \"da_id\":\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status",
            "description": "<p>Always &quot;error&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code",
            "description": "<p>Status code</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "response",
            "description": "<p>Error name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "400 Bad Request",
          "content": "{\n     \"error\": \"No username specified\"\n}",
          "type": "json"
        },
        {
          "title": "400 Bad Request",
          "content": "{\n     \"error\": \"Invalid credentials\"\n}",
          "type": "json"
        },
        {
          "title": "404 Not found",
          "content": "HTTP/1.1 404 Not Found\nData in request do not exist.\n{\n  \"status\": \"error\"\n  \"code\": 404\n  \"response\": \"NotFound\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/password-reset",
    "title": "Change password after reset request",
    "version": "0.1.0",
    "name": "pwdReset",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X POST 'https://api-wbc.fomazov.name/password-reset' -d 'code=000000000' -d 'password=123456789' -d 'password_repeat=123456789' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>reset code</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>reset new password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_repeat",
            "description": "<p>password repeat</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n  \"status\": \"success\"\n  \"code\": 200\n  \"response\": {\"email\":\"codecept_test_3@custom.com\"}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status",
            "description": "<p>Always &quot;error&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code",
            "description": "<p>Status code</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "response",
            "description": "<p>Error name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "401 Error",
          "content": "{\n    \"status\": \"error\"\n    \"code\": 401\n    \"response\": {\n        \"message\":[\n            \"?????? ?????????? ???????????? ???? ???????????? ?????? ??????????????\",\n            \"???????????????????? ???????????????? ?????????????? ????????????\",\n            \"???????????? ???? ??????????????????\"\n        ]\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/password-reset/check",
    "title": "Send request to reset password",
    "version": "0.1.0",
    "name": "pwdResetCheck",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X POST 'https://api-wbc.fomazov.name/password-reset/check' -d 'code=000000000' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>reset code</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n  \"status\": \"success\"\n  \"code\": 200\n  \"response\": {\n     \"message\":[\"ok\"]\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status",
            "description": "<p>Always &quot;error&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code",
            "description": "<p>Status code</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "response",
            "description": "<p>Error name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "401 Error",
          "content": "{\n    \"status\": \"error\"\n    \"code\": 401\n    \"response\": {\n        \"message\":[\n            \"?????? ?????????? ???????????? ???? ???????????? ?????? ??????????????\"\n        ]\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/password-reset/send",
    "title": "Send request to reset password",
    "version": "0.1.0",
    "name": "pwdResetSend",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X POST 'https://api-wbc.fomazov.name/password-reset/send' -d 'email=sample@test.com' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User E-Mail</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n  \"status\": \"success\"\n  \"code\": 200\n  \"response\": {\n     \"message\":[\n         \"???? ?????????????????? ???????? ?????????? ?????????????? ???????????? ?????? ?????????????????????????? ?????????? ????????????\"\n     ]\n  }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status",
            "description": "<p>Always &quot;error&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code",
            "description": "<p>Status code</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "response",
            "description": "<p>Error name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "401 Error",
          "content": "{\n    \"status\": \"error\"\n    \"code\": 401\n    \"response\": {\n        \"message\":[\n            \"Email ???? ????????????\"\n        ]\n     }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/register",
    "title": "Register User",
    "version": "0.1.0",
    "name": "registerUser",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X POST 'https://api-wbc.fomazov.name/register' -d 'email=sample@test.com' -d 'password=pwd'  -d 'first_name=%user_first_name%'  -d 'last_name=%user_last_name%' -H 'Content-Type : application/x-www-form-urlencoded' -H 'locale : %ru_or_en%",
        "type": "json"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User E-Mail</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>User password</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "first_name",
            "description": "<p>User first name</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "last_name",
            "description": "<p>User last name</p>"
          }
        ]
      }
    },
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n  \"status\": \"success\"\n  \"code\": 200\n  \"response\":\n     {\n        \"id\":\n        \"code\":\n        \"email\":\n        \"password\":\n        \"first_name\":\n        \"last_name\":\n        \"created_at\":\n        \"updated_at\":\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status",
            "description": "<p>Always &quot;error&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code",
            "description": "<p>Status code</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "response",
            "description": "<p>Error name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "401 Error",
          "content": "{\n    \"status\": \"error\"\n    \"code\": 401\n    \"response\": {\n        \"message\": {\n            \"email\": \"email is required\"\n            \"password\": \"???????? '????????????' ?????????????????????? ?????? ????????????????????\"\n            \"first_name\": \"???????? '??????' ?????????????????????? ?????? ????????????????????\"\n            \"last_name\": \"???????? '??????????????' ?????????????????????? ?????? ????????????????????\"\n        }\n    }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "get",
    "url": "/userinfo",
    "title": "User Info",
    "version": "0.1.0",
    "name": "userInfo",
    "group": "Auth",
    "permission": [
      {
        "name": "utGuest"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X GET 'https://api-wbc.fomazov.name/userinfo' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'",
        "type": "json"
      }
    ],
    "success": {
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n  \"status\": \"success\"\n  \"code\": 200\n  \"response\":\n     {\n         \"id\":\n         \"area\":\n         \"auth_hash\":\n         \"author_id\":\n         \"client_status\":\n         \"default_locale\":\n         \"first_name\":\n         \"second_name\":\n         \"last_name\":\n         \"first_name_ru\":\n         \"second_name_ru\":\n         \"last_name_ru\":\n         \"password\":\n         \"token\":\n         \"is_hidden\":\n         \"is_players_valid\":\n         \"region\":\n         \"timezone\":\n         \"user_type\":\n         \"expired_date\":\n         \"created_at\":\n         \"updated_at\":\n     }\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "examples": [
        {
          "title": "401 Error",
          "content": "HTTP/1.1 401 Error\n{\n  \"status\": \"error\"\n  \"code\": 401\n  \"response\": null\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Auth.php",
    "groupTitle": "Auth"
  },
  {
    "type": "get",
    "url": "/clients/getByCurrentToken",
    "title": "Read client by current token",
    "version": "0.1.0",
    "name": "getByCurrentToken",
    "group": "Client",
    "permission": [
      {
        "name": "utUser"
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X GET 'https://api-wbc.fomazov.name/clients/getByCurrentToken' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>The User ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User E-Mail address.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "firstName",
            "description": "<p>FirstName of the User.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lastName",
            "description": "<p>LastName of the User.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n  \"status\": \"success\"\n  \"code\": 200\n  \"response\": {\n         \"id\": 105,\n         \"firstName\": \"first name\",\n         \"lastName\": \"last name\",\n         \"firstNameRu\": \"first name\",\n         \"lastNameRu\": \"last name\",\n         \"userType\": \"utVerifiedUser\",\n         \"companyId\": 0,\n         \"online\": false,\n   }\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Client.php",
    "groupTitle": "Client",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Content-Type</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>SSO broker Id (str)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "secret",
            "description": "<p>SSO broker secret</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Client Token</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "locale",
            "description": "<p>Language</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status",
            "description": "<p>Always &quot;error&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code",
            "description": "<p>Status code</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "response",
            "description": "<p>Error name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "401 Unauthorized",
          "content": "HTTP/1.1 401 Unauthorized\nOnly authenticated users can access the data.\n{\n  \"status\": \"error\"\n  \"code\": 401\n  \"response\": \"Unauthorized\"\n}",
          "type": "json"
        },
        {
          "title": "403 Permission denied",
          "content": "HTTP/1.1 403 Permission denied\nNot enough access rights.\n{\n  \"status\": \"error\"\n  \"code\": 403\n  \"response\": \"Permission denied\"\n}",
          "type": "json"
        },
        {
          "title": "404 Not found",
          "content": "HTTP/1.1 404 Not Found\nData in request do not exist.\n{\n  \"status\": \"error\"\n  \"code\": 404\n  \"response\": \"NotFound\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "get",
    "url": "/clients/getByIds/{ids:[0-9,]+}",
    "title": "Get list of client by id list",
    "version": "0.1.0",
    "name": "getByIds",
    "group": "Client",
    "permission": [
      {
        "name": "utUser"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "ids",
            "description": "<p>list of ids, coma separated</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Content-Type</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>SSO broker Id (str)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "secret",
            "description": "<p>SSO broker secret</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Client Token</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "locale",
            "description": "<p>Language</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X GET 'https://api-wbc.fomazov.name/clients/getByIds/1,2,3' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>The User ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User E-Mail address.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "firstName",
            "description": "<p>FirstName of the User.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lastName",
            "description": "<p>LastName of the User.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n    \"status\": \"success\"\n    \"code\": 200\n    \"response\": [\n        {\n            \"id\": 105,\n            \"firstName\": \"first name\",\n            \"lastName\": \"last name\",\n            \"firstNameRu\": \"first name\",\n            \"lastNameRu\": \"last name\",\n            \"userType\": \"utUser\",\n            \"online\": false,\n        },\n        ...\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Client.php",
    "groupTitle": "Client",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status",
            "description": "<p>Always &quot;error&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code",
            "description": "<p>Status code</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "response",
            "description": "<p>Error name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "401 Unauthorized",
          "content": "HTTP/1.1 401 Unauthorized\nOnly authenticated users can access the data.\n{\n  \"status\": \"error\"\n  \"code\": 401\n  \"response\": \"Unauthorized\"\n}",
          "type": "json"
        },
        {
          "title": "403 Permission denied",
          "content": "HTTP/1.1 403 Permission denied\nNot enough access rights.\n{\n  \"status\": \"error\"\n  \"code\": 403\n  \"response\": \"Permission denied\"\n}",
          "type": "json"
        },
        {
          "title": "404 Not found",
          "content": "HTTP/1.1 404 Not Found\nData in request do not exist.\n{\n  \"status\": \"error\"\n  \"code\": 404\n  \"response\": \"NotFound\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/clients/getByNameInIds",
    "title": "Get list of client by name and id list",
    "version": "0.1.0",
    "name": "getByNameInIds",
    "group": "Client",
    "permission": [
      {
        "name": "utUser"
      }
    ],
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>part of name</p>"
          },
          {
            "group": "Parameter",
            "type": "Array",
            "optional": false,
            "field": "ids",
            "description": "<p>array of ids</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "Content-Type",
            "description": "<p>Content-Type</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>SSO broker Id (str)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "secret",
            "description": "<p>SSO broker secret</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Client Token</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "locale",
            "description": "<p>Language</p>"
          }
        ]
      }
    },
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl -X POST 'https://api-wbc.fomazov.name/clients/getByNameInIds' -H 'Content-Type : application/json' -H 'id : %broker_id%' -H 'secret : %broker_secret%' -H 'token : %token%' -H 'locale : %ru_or_en%'",
        "type": "json"
      }
    ],
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>The User ID.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>User E-Mail address.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "firstName",
            "description": "<p>FirstName of the User.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "lastName",
            "description": "<p>LastName of the User.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "200 Success",
          "content": "HTTP/1.1 200 Success\n{\n    \"status\": \"success\"\n    \"code\": 200\n    \"response\": [\n        {\n            \"id\": 105,\n            \"firstName\": \"first name\",\n            \"lastName\": \"last name\",\n            \"firstNameRu\": \"first name\",\n            \"lastNameRu\": \"last name\",\n            \"userType\": \"utVdUser\",\n            \"companyId\": 0,\n            \"lastVisit\": \"2019-12-22 12:24:51\",\n            \"online\": false,\n        },\n        ...\n    ]\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/routes/Client.php",
    "groupTitle": "Client",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "status",
            "description": "<p>Always &quot;error&quot;</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "code",
            "description": "<p>Status code</p>"
          },
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "response",
            "description": "<p>Error name</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "401 Unauthorized",
          "content": "HTTP/1.1 401 Unauthorized\nOnly authenticated users can access the data.\n{\n  \"status\": \"error\"\n  \"code\": 401\n  \"response\": \"Unauthorized\"\n}",
          "type": "json"
        },
        {
          "title": "403 Permission denied",
          "content": "HTTP/1.1 403 Permission denied\nNot enough access rights.\n{\n  \"status\": \"error\"\n  \"code\": 403\n  \"response\": \"Permission denied\"\n}",
          "type": "json"
        },
        {
          "title": "404 Not found",
          "content": "HTTP/1.1 404 Not Found\nData in request do not exist.\n{\n  \"status\": \"error\"\n  \"code\": 404\n  \"response\": \"NotFound\"\n}",
          "type": "json"
        }
      ]
    }
  },
  {
    "type": "post",
    "url": "/webhook/acl_rewrite",
    "title": "- Acl Rewrite",
    "version": "0.1.0",
    "name": "aclRewrite",
    "group": "Webhook",
    "permission": [
      {
        "name": "\"utRobot\""
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl --request POST /usr/bin/curl  -H \"Accept: application/json\" -H 'Content-Type: application/json' -H 'id: %brokerName%' -H 'secret: %brokerSecret%' -H 'token: %token%' https://api-wbc.fomazov.name/webhook/acl_rewrite",
        "type": "json"
      }
    ],
    "filename": "app/routes/Webhook.php",
    "groupTitle": "Webhook"
  },
  {
    "type": "post",
    "url": "/webhook/route_rewrite",
    "title": "- Route Rewrite",
    "version": "0.1.0",
    "name": "routeRewrite",
    "group": "Webhook",
    "permission": [
      {
        "name": "\"utRobot\""
      }
    ],
    "examples": [
      {
        "title": "Example usage:",
        "content": "/usr/bin/curl --request POST /usr/bin/curl  -H \"Accept: application/json\" -H 'Content-Type: application/json' -H 'id: %brokerName%' -H 'secret: %brokerSecret%' -H 'token: %token%' https://api-wbc.fomazov.name/webhook/route_rewrite",
        "type": "json"
      }
    ],
    "filename": "app/routes/Webhook.php",
    "groupTitle": "Webhook"
  }
] });
