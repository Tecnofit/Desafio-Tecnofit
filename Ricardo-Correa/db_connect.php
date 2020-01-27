<?php 
 
$localhost = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "db_ricardo_correa"; 
 
// criar conexao
$connect = new mysqli($localhost, $username, $password, $dbname); 
 
// Checar conexão
if($connect->connect_error) {
    die("Falha de conexão com MySQL : " . $connect->connect_error);
} else {
     //echo "Conexão como MySQL estabelecida.";
}
 
?>