<?php
session_start();
include_once("conexao_aluno.php");

$idexercicio = filter_input(INPUT_GET, 'idexercicio', FILTER_SANITIZE_NUMBER_INT);
$result_exercicio = "DELETE FROM exercicio WHERE idexercicio = '$idexercicio'";
$resultado_exercicio = mysqli_query($conexao, $result_exercicio);

if(mysqli_affected_rows($conexao)) {
	$_SESSION['status_exclusao'] = true;
}

$conexao->close();

header('Location: exercicios.php');
exit;

?>