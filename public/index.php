<?php
$cliPath = realpath(__DIR__ . '/../cli');
include $cliPath . '/startApp.php';

try {
    $app = new \Phalcon\Mvc\Micro();
    $startApp = new StartApp();
    $startApp->setApp($app);
    $startApp->start();

} catch (\Exception $e) {
    if($e instanceof Phalcon\Exception){
        exceptionResponse($app, $e, 400, 'Bad Request');
    } else {
        exceptionResponse($app, $e, 500, 'Internal Server Error');
    }
}
LoggerTime::log('after app');

ExceptionThrower::Stop();

LoggerTime::log('end');
