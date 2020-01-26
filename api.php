<?php
include 'DB.php';
$db = new DB();

$acao = '';

if (isset($_POST['acao'])) {
	$acao = $_POST['acao'];
}

if ($acao == 'incluir') {
	$nome = $_POST['nome'];
	$status = $_POST['status'];
	$dt_nascimento = $_POST['dt_nascimento'];
	$cep = $_POST['cep'];
	$endereco = $_POST['endereco'];
	$numero = $_POST['numero'];
	$bairro = $_POST['bairro'];
	$uf = $_POST['uf'];
	$cidade = $_POST['cidade'];
	$telefone = $_POST['telefone'];
	$celular = $_POST['celular'];
	$email = $_POST['email'];
	$treino_atual = $_POST['treino_atual'];

	$sql = "INSERT INTO alunos (nome, status, treino_ativo, dt_nascimento, cep, endereco, numero, bairro, uf, cidade, telefone, celular, email, created) 
            VALUES ('$nome', '$status', '$treino_atual' '$dt_nascimento', '$cep', '$endereco', '$numero', '$bairro', '$uf', '$cidade', '$telefone', '$celular', '$email', '".date('Y-m-d')."') ";


    $result = $db->execute($sql);

	if ($result) {
        echo 'ok';
		exit;
	} else{
        echo 'err';
		exit;
	}
}

if ($acao == 'alterar') {
	$id = $_POST['id'];
    $nome = $_POST['nome'];
    $status = $_POST['status'];
    $dt_nascimento = $_POST['dt_nascimento'];
    $cep = $_POST['cep'];
    $endereco = $_POST['endereco'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $uf = $_POST['uf'];
    $cidade = $_POST['cidade'];
    $telefone = $_POST['telefone'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $treino_atual = $_POST['treino_atual'];

    $sql = "UPDATE alunos SET nome = '$nome', status = '$status', treino_ativo = '$treino_atual', dt_nascimento = '$dt_nascimento', endereco = '$endereco', numero = '$numero',
        bairro = '$bairro', uf = '$uf', cidade = '$cidade', telefone = '$telefone', celular = '$celular',  email = '$email', modified = '".date('Y-m-d')."' WHERE id = '$id'";//echo $sql;exit;

    $result = $db->execute($sql);

	if ($result) {
		echo 'ok';
		exit;
	} else{
        echo 'err';
		exit;
	}
}

if ($acao == 'deletar') {
	$id = $_POST['id'];

	$sql = "DELETE FROM alunos where id = '$id'";
    $result = $db->execute($sql);

	if ($result) {
		echo 'ok';
		exit;
	} else{
	    echo 'err';
		exit;
	}
}

?>