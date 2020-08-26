#!/usr/bin/env php
<?php

define('CLI_APP', true);
include __DIR__ . '/startApp.php';
include __DIR__ . '/consoleApp.php';

try {
    $app = new \Phalcon\CLI\Console();
    $startApp = new ConsoleApp();
    $startApp->setApp($app);
    $startApp->start();

} catch (\Exception $e) {
    echo (string) $e;
}
LoggerTime::log('after app');

ExceptionThrower::Stop();

LoggerTime::log('end');