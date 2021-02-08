<?php
include_once('../includes/conectai.inc.php');
include_once('../classes/Util.php');
include_once('../classes/Lista.php');

function treino($idAluno, $acao = null, $idExe = null)
{
	$dd = array();
	$dados = array();
	$lista = new Lista;
	$lista->tabela = 'treino';

	if ($acao == 'finalizar') {
		$lista->consulta = "SELECT sessoes FROM treino WHERE id ='" . $idExe . "'";
		$resultf = $lista->dados();
		$resf = mysqli_fetch_assoc($resultf['RES']);
		$atualiza = array('sessoes' => ($resf['sessoes'] - 1));
		$result = $lista->upserting($atualiza, $idExe);
	}

	$lista->consulta = "SELECT 
		t.id,
		t.idExercicio,
		t.sessoes,
		e.nome
	FROM
		treino t
	LEFT JOIN exercicio e ON (E.id = t.idExercicio)
	WHERE
		t.idAluno = " . $idAluno . " AND t.finalizado = 0 AND t.sessoes != '0'
	ORDER BY e.nome ASC";
	$result = $lista->dados();
	while ($res = mysqli_fetch_assoc($result['RES'])) {
		$dd[] = $res;
	}

	if ($dd) {
		for ($x = 0; $x < 50; $x++) {
			for ($i = 0; $i < count($dd); $i++) {
				$dados[] = $dd[$i];
			}
		}
		//echo '<pre>' . print_r($dd, 1) . '</pre><hr>';
		//echo '<pre>' . print_r($dados, 1) . '</pre><hr>';

		$treino = array();
		if ($acao == 'pular') {
			$posicao = array_search($idExe, array_column($dados, 'id'));
			$treino[0] = $dados[$posicao];
			$treino[1] = $dados[$posicao + 1];
		} elseif ($acao == 'finalizar') {
			$posicao = array_search($idExe, array_column($dados, 'id'));
			$treino[0] = $dados[$posicao + 1];
			$treino[1] = $dados[$posicao + 2];
		} else {
			for ($i = 0; $i < 2; $i++) {
				$treino[] = $dados[$i];
			}
		}
	}

	return $treino;
}

if (isset($_GET['id'])) {
	$id = Util::tratar($_GET['id']);
	$acao = isset($_GET['acao']) ? Util::tratar($_GET['acao']) : '';
	$idExe = isset($_GET['idExe']) ? Util::tratar($_GET['idExe']) : '';

	if (is_numeric($id)) {
		$treino = treino($id, $acao, $idExe);
		if ($treino) {
			$form_data['success'] 	= true;
			$form_data['dados'] 	= $treino;
		} else {
			$form_data['success'] 	= false;
			$form_data['msg'] 		= 'Nenhum treino encontrado';
		}
	} else {
		$form_data['success'] 	= false;
		$form_data['msg'] 		= 'Requisicao Invalida';
	}
}

//Util::gerarLog($form_data, "treino");

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');
echo json_encode($form_data);
