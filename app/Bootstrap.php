<?php
/**
 * Bootstrap file
 * versie 1.2
 */

// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);

require_once (ROOT . DS . 'app' . DS . 'Config' . DS . 'config.php');

require_once (ROOT . DS . 'lib' . DS . 'Router.php');