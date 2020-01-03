<?php
session_start();
include_once("conexao_aluno.php");

$idaluno = filter_input(INPUT_GET, 'idaluno', FILTER_SANITIZE_NUMBER_INT);
$result_aluno = "DELETE FROM aluno WHERE idaluno = '$idaluno'";
$resultado_aluno = mysqli_query($conexao, $result_aluno);

if(mysqli_affected_rows($conexao)) {
	$_SESSION['status_exclusao'] = true;
}

$conexao->close();

header('Location: alunos.php');
exit;

?>