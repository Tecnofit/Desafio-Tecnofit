<?php
 require_once("../db_connect.php");
 session_start();

$id = $_GET['id'];
$series = $_GET['series'];
$nome = str_replace("'", "", $_GET['nome']);

$query = "update tb_treino set nome = '$nome', series=$series where id_treino=$id";

$resultado = mysqli_query($connect, $query);

$_SESSION['msg'] = "Treino '$nome' alterado com sucesso.";

var_dump($_GET);

?>