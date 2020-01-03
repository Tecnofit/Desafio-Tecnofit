<?php
if(!$_SESSION['nome']) {
	header('Location: index.php');
	exit();
}