<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

function __autoload($class)
{
	include ('src/' . str_replace('\\', '/', $class) . '.php');
}

$app = new ExampleApp();
$state = $app->boot();
$app->run($state);
