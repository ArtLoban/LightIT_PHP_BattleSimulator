<?php

/* PHP version 7.0+ */

/* Composer autoload */
require __DIR__ . '/vendor/autoload.php';

/* Errors */
error_reporting(E_ALL);

$simulation = new \App\SimulatorController();
$simulation->start();

