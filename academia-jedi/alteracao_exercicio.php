<?php
session_start();
include_once("conexao_aluno.php");

$idexercicio = mysqli_real_escape_string($conexao, trim($_POST['idexercicio']));
$nome_exercicio = mysqli_real_escape_string($conexao, trim($_POST['nome_exercicio']));
$serie_exercicio = mysqli_real_escape_string($conexao, trim($_POST['serie_exercicio']));
$repeticoes_exercicio = mysqli_real_escape_string($conexao, trim($_POST['repeticoes_exercicio']));
$descricao_exercicio = mysqli_real_escape_string($conexao, trim($_POST['descricao_exercicio']));

$result_exercicio = "UPDATE exercicio SET nome_exercicio ='$nome_exercicio', serie_exercicio = '$serie_exercicio', repeticoes_exercicio = '$repeticoes_exercicio', descricao_exercicio = '$descricao_exercicio' WHERE idexercicio = '$idexercicio'";

$resultado_exercicio = mysqli_query($conexao, $result_exercicio);

if(mysqli_affected_rows($conexao)) {
	$_SESSION['status_alteracao'] = true;
}

$conexao->close();

header('Location: exercicios.php');
exit;

?>
