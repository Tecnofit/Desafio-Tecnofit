<?php

function conn(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbName = "test";

  $conn = new mysqli($servername, $username, $password, $dbName);

  if ($conn->connect_error) {
    die("Erro de Conexão: " . $conn->connect_error);
  }else{
    return $conn;
  }

}
?>
