<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

define('DS', DIRECTORY_SEPARATOR);
define('BASE_PATH', __DIR__);

$loader = require 'vendor/autoload.php';

$app = new Example\App();
$app->run();