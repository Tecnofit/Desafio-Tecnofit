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
	$status = $_POST['status'];
	$exercicios = $_POST['exercicios'];

	$sql = "INSERT INTO treinos (nome, descricao, status, created) VALUES ('$nome', '$descricao', '$status', '".date('Y-m-d')."')";
    $result = $db->execute($sql);

    $sql = "SELECT id FROM treinos  order by id desc limit 1";
    $result = $db->execute($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $id = $row['id'];
    }

    foreach ($exercicios as $e){
        $id_exercicio = $e['id_exercicio'];
        $reps = $e['repeticoes'];

        $sql = "INSERT INTO exercicios_treino (id_treino, id_exercicio, repeticoes) VALUES ('$id', '$id_exercicio', '$reps')";
        $result = $db->execute($sql);
    }

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
    $status = $_POST['status'];
    $exercicios = $_POST['exercicios'];

    $sql = "UPDATE treinos SET nome = '$nome', descricao = '$descricao', status = '$status', modified = '".date('Y-m-d')."' WHERE id = '$id'";
    $result = $db->execute($sql);

    $sql = "DELETE from exercicios_treino WHERE id_treino = '$id'";
    $result = $db->execute($sql);

    foreach ($exercicios as $e){
        $id_exercicio = $e['id_exercicio'];
        $reps = $e['repeticoes'];

        $sql = "INSERT INTO exercicios_treino (id_treino, id_exercicio, repeticoes) VALUES ('$id', '$id_exercicio', '$reps')";
        $result = $db->execute($sql);
    }

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

	$sql = "DELETE FROM treinos where id = '$id'";
    $result = $db->execute($sql);

	if ($result) {
		echo 'ok';
		exit;
	} else{
	    echo 'err';
		exit;
	}
}

if ($acao == 'busca_treino') {
    $id = $_POST['id_treino'];

    $sql = "SELECT * FROM exercicios_treino where id_treino = '$id'";
    $result = $db->execute($sql);

    if ($result) {
        echo json_encode($result);
        exit;
    } else{
        echo 'err';
        exit;
    }
}

?>