<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__);

$loader = require 'vendor/autoload.php';

$app_class_name = $argv[1] . "\App";
$app = new $app_class_name();
$app->run();