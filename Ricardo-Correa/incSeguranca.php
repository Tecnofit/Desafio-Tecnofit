<?php

if(isset($_SESSION['TipoUsuario'])){
    if($_SESSION['TipoUsuario'] != "ADMINISTRADOR"){
        alert("Ação não permitida!");
        header("Location: logoff.php");
    }
}
else{
    alert("Ação não permitida!");
    header("Location: logoff.php"); 
}

require_once("db_connect.php");

?>