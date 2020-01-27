<?php

if(! isset($_SESSION['TipoUsuario'])){
    alert("Ação não permitida!");
    header("Location: logoff.php"); 
}

require_once("db_connect.php");

?>