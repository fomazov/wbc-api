<?php

return array(
    array('/webhook/ci', 'post', 'getHook'),
    array('/webhook/acl_rewrite', 'post', 'aclRewrite'),
    array('/webhook/route_rewrite', 'post', 'routeRewrite'),
);

/**
 * @api {post} /webhook/acl_rewrite - Acl Rewrite
 * @apiVersion 0.1.0
 * @apiName aclRewrite
 * @apiGroup Webhook
 *
 * @apiPermission "utRobot"
 *
 * @apiExample Example usage:
 * /usr/bin/curl --request POST /usr/bin/curl  -H "Accept: application/json" -H 'Content-Type: application/json' -H 'id: %brokerName%' -H 'secret: %brokerSecret%' -H 'token: %token%' https://api-wbc.fomazov.name/webhook/acl_rewrite
 *
 */

/**
 * @api {post} /webhook/route_rewrite - Route Rewrite
 * @apiVersion 0.1.0
 * @apiName routeRewrite
 * @apiGroup Webhook
 *
 * @apiPermission "utRobot"
 *
 * @apiExample Example usage:
 * /usr/bin/curl --request POST /usr/bin/curl  -H "Accept: application/json" -H 'Content-Type: application/json' -H 'id: %brokerName%' -H 'secret: %brokerSecret%' -H 'token: %token%' https://api-wbc.fomazov.name/webhook/route_rewrite
 *
 */