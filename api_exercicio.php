<?php
include 'DB.php';
$db = new DB();

$acao = '';

if (isset($_POST['acao'])) {
	$acao = $_POST['acao'];
}

if ($acao == 'incluir') {
	$nome = $_POST['nome'];
	$descricao = $_POST['descricao'];

	$sql = "INSERT INTO exercicios (nome, descricao, created) VALUES ('$nome', '$descricao', '".date('Y-m-d')."') ";
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
    $descricao = $_POST['descricao'];

    $sql = "UPDATE exercicios SET nome = '$nome', descricao = '$descricao', modified = '".date('Y-m-d')."' WHERE id = '$id'";
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

	$sql = "select * from exercicios_treino where id_exercicio = $id";
	$result = $db->execute($sql);
    if($result->num_rows > 0){
        echo 'naopode';
        exit;
    }

	$sql = "DELETE FROM exercicio where id = '$id'";
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