<?php
session_start();
include_once("conexao_aluno.php");

$idaluno = mysqli_real_escape_string($conexao, trim($_POST['idaluno']));
$nomealuno = mysqli_real_escape_string($conexao, trim($_POST['nomealuno']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
$altura = mysqli_real_escape_string($conexao, trim($_POST['altura']));
$peso = mysqli_real_escape_string($conexao, trim($_POST['peso']));

$result_aluno = "UPDATE aluno SET nomealuno ='$nomealuno', email = '$email', endereco = '$endereco', altura = '$altura', peso = '$peso' WHERE idaluno = '$idaluno'";
$resultado_aluno = mysqli_query($conexao, $result_aluno);

if(mysqli_affected_rows($conexao)) {
	$_SESSION['status_alteracao'] = true;
}

$conexao->close();

header('Location:alunos.php');
exit;

?>
