<?php
/**
 * Application Name
 * Same as repo name
 */
if(!defined('APPLICATION_NAME')) define('APPLICATION_NAME','solvire-utilities');

require_once realpath( __DIR__ . '/../vendor/autoload.php');
require_once realpath( __DIR__ . '/BaseTestCase.php' );

$dotenv = new Dotenv\Dotenv(realpath(__DIR__ . "/../"));
$dotenv->load();