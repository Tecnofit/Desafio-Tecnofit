<?php
$host       = "localhost";
$database   = "fred01";
$user 		= "root";
$password 	= "";

$GLOBALS['my'] = mysqli_connect($host,$user,$password,$database) or die("DB NAO ENCONTRADA EM ".date('d-m-Y H:i:s')."");
?>