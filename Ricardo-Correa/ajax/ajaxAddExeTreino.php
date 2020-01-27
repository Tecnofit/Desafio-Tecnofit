<?php
 require_once("../db_connect.php");
 session_start();

$id = $_GET['id'];
$idExercicio = $_GET['idExercicio'];
$NumR = $_GET['NumR'];

$query = "insert into tb_treino_exercicio(id_treino,id_exercicio,numrepeticoes) values($id, $idExercicio, $NumR);";

$resultado = mysqli_query($connect, $query);

$_SESSION['msg'] = "Exercício incluído neste treino com sucesso.";

var_dump($_GET);

?>