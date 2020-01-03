<?php
session_start();
include('conexao_aluno.php');

if(empty($_POST['idaluno']) || empty($_POST['email'])) {
	header('Location: index_aluno.php');
	exit();
}

$idaluno = mysqli_real_escape_string($conexao, $_POST['idaluno']);
$email = mysqli_real_escape_string($conexao, $_POST['email']);

$query = "select nomealuno from aluno where idaluno = {$idaluno} and email = '{$email}'";

$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);

if($row == 1){
	$usuario_bd = mysqli_fetch_assoc($result);
  $_SESSION['nomealuno'] = $usuario_bd['nomealuno'];
  header('Location: painel_aluno.php');
  exit();
	} else {
		$_SESSION['nao_localizado'] = true;
		header('Location: index_aluno.php');
		exit();

}
?>