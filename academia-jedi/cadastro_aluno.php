<?php
session_start();
include("conexao_aluno.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nomealuno']));
$email = mysqli_real_escape_string($conexao, trim($_POST['email']));
$endereco = mysqli_real_escape_string($conexao, trim($_POST['endereco']));
$altura = mysqli_real_escape_string($conexao, trim($_POST['altura']));
$peso = mysqli_real_escape_string($conexao, trim($_POST['peso']));

$validar_nome = "select count(*) as total from aluno where nomealuno = '$nome'";
$result = mysqli_query($conexao, $validar_nome);
$row = mysqli_fetch_assoc($result);

if($row['total'] == 1){
	$_SESSION['nome_existe'] = true;
	header('Location: cadastrar_aluno.php');
	exit;
}

$sql = "INSERT INTO aluno (nomealuno, email, endereco, altura, peso, datacadastro) VALUES ('$nome', '$email', '$endereco', '$altura', '$peso', NOW())";

if($conexao->query($sql) === TRUE) {
	$_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Location: alunos.php');
exit;

?>
