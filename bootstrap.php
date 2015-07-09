<?php
require_once __DIR__  . '/vendor/autoload.php';

/*
 * Load up environment variables 
 * Remember to set the .env.example to simply .env 
 * add your secrets  
 */
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

