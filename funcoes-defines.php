<?php

    include_once __DIR__ . '/vendor/autoload.php';

    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

	$ADODB_CACHE_DIR = './ADODB_cache';

	define("BASE_URL", $_ENV['BASE_URL']);
	define("BASE_PATH", $_ENV['BASE_PATH']);
	
	// error_reporting(E_ERROR | E_WARNING | E_PARSE);
	error_reporting(0);

?>