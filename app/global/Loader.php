<?php

/**
 * Registering an autoloader
 */

$loader = new \Phalcon\Loader();

$loader->registerNamespaces($config->namespaces->toArray());

// Register autoloader
$loader->register();