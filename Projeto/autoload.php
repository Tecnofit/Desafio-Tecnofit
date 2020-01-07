<?php

spl_autoload_register(function($class) {
	$arquivo = $class. '.php';
	if(file_exists($arquivo))
		include $class . '.php';
});