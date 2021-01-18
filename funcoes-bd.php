<?php

    include('adodb/adodb.inc.php');

	$_SESSION['db'] = adoNewConnection('mysqli'); # eg. 'mysqli' or 'oci8'
    $_SESSION['db']->connect($_ENV['DB_HOST'],$_ENV['DB_USER'],$_ENV['DB_PASS'],$_ENV['DB_BASE']);
	if ($_ENV['DEBUG'] == "true") {
		$_SESSION['db']->debug = true;
	}
