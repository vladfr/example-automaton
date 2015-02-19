<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

function __autoload($class)
{
    $path = str_replace('MS\\Automaton\\', 'src/', $class);
    $path = str_replace('\\', '/', $path);
    include($path . '.php');
}

$app = new Example\App();
$app->run();
