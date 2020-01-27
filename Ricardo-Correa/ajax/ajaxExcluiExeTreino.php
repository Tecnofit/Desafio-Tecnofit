<?php
 require_once("../db_connect.php");
 session_start();

 $id = $_GET['id'];
 $idExercicio = $_GET['idExercicio'];

 $query = "delete from tb_treino_exercicio where id_treino=$id and id_exercicio=$idExercicio";
 $resultado = mysqli_query($connect, $query);

 $_SESSION['msg'] = "Exercício deste treino excluído com sucesso";

var_dump($_GET);

?>