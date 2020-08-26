<?php

$utUser = array(
    'AuthController' => array(
        'checkOk'
    ),
    'ClientController' => array(
        'getByCurrentToken',
        'getByIds', 'getByName', 'getByNameInIds'
    )
);

$allowList = array(
    'utRobot' => array(
        'WebhookController' => array(
            'aclRewrite', 'routeRewrite'
        )
    ),
    'utGuest' => array(
        'AuthController' => array(
            'login', 'userInfo', 'attach', 'logout', 'registerUser', 'pwdResetSend', 'pwdReset', 'pwdResetCheck',
            'activateUser', 'activateEmailUser', 'activateLoginUser'
        )
    ),
    'utUser'            => $utUser
);

unset($utUser);

return $allowList;