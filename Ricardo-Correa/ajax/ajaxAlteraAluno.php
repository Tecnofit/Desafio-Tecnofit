<?php
 require_once("../db_connect.php");
 session_start();

$id = $_GET['id'];
$nome = str_replace("'", "", $_GET['nome']);
$email = str_replace("'", "", $_GET['email']);
$id_treino = $_GET['id_treino'];

$query = "update tb_aluno set nome = '$nome', email='$email', id_treino='$id_treino' where id_aluno=$id";

$resultado = mysqli_query($connect, $query);

$_SESSION['msg'] = "Usuário '$nome' alterado com sucesso.";

var_dump($_GET);

?>