<?php
session_start();
include("conexao_aluno.php");

$nome_exercicio = mysqli_real_escape_string($conexao, trim($_POST['nome_exercicio']));
$serie = mysqli_real_escape_string($conexao, trim($_POST['serie_exercicio']));
$repeticoes = mysqli_real_escape_string($conexao, trim($_POST['repeticoes_exercicio']));
$descricao = mysqli_real_escape_string($conexao, trim($_POST['descricao_exercicio']));

$sql = "INSERT INTO exercicio (nome_exercicio, serie_exercicio, repeticoes_exercicio, descricao_exercicio) VALUES ('$nome_exercicio', '$serie', '$repeticoes', '$descricao')";

if($conexao->query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: exercicios.php');
exit;

?>
