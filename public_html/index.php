<?php
session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

$url = $_SERVER['REQUEST_URI'];

require_once (ROOT . DS . 'app' . DS . 'Bootstrap.php');