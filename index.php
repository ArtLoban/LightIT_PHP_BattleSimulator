<?php
/* PHP version 7.2+ */

/* Errors */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Composer autoload */
require __DIR__ . '/vendor/autoload.php';

$container = new \Services\ClassFactory\Factory();

$simulation = $container->create(\App\SimulatorController::class);
$simulation->start();
