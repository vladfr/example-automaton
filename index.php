<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

function exception_error_handler($errno, $errstr, $errfile, $errline ) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__);

$loader = require 'vendor/autoload.php';

$app_class_name = 'Api' . "\App";
$app = new $app_class_name();
$app->run();