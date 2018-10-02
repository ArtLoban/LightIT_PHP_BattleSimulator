<?php

/* PHP version 7.0+ */

/* Errors */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Composer autoload */
require __DIR__ . '/vendor/autoload.php';

$factory = new \Services\ClassFactory\Factory();

$simulation = $factory->create(\App\SimulatorController::class);
$simulation->start();
