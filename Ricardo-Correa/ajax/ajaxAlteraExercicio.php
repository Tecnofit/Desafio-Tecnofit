<?php
 require_once("../db_connect.php");
 session_start();

$id = $_GET['id'];
$nome = str_replace("'", "", $_GET['nome']);

$query = "update tb_exercicio set nome = '$nome' where id_exercicio=$id";

$resultado = mysqli_query($connect, $query);

$_SESSION['msg'] = "Exercício '$nome' alterado com sucesso.";

var_dump($_GET);

?>