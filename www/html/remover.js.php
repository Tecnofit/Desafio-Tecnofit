<?php
include_once('../includes/conectai.inc.php');
include_once('../classes/Util.php');
include_once('../classes/Lista.php');

if ($_POST) {
	$form_data = array();
	$erro = '';
	$erroMsg = '';
	$upserting = array();

	$idUp = Util::tratarNum($_POST['id']);
	$tipo = Util::tratar($_POST['tipo']);

	switch ($tipo) {
		case 'exe':
			$tabela = 'exercicio';
			break;
		case 'alu':
			$tabela = 'aluno';
			break;
		case 'tre':
			$tabela = 'treino';
			break;
		default:
			$tabela = '';
			break;
	}

	if($idUp&&$tabela){
		$lista = new Lista;
		$lista->tabela = $tabela;
		$campos['ativo'] = '0';
		$upserting = $lista->upserting($campos, $idUp);

		if($upserting['STATUS']=='OK'){
			$form_data['success'] 	= true;
			$form_data['msg'] 		= '';
		}else{
			$form_data['success'] 	= false;
			$form_data['msg'] 		= $upserting['MSG'];
		}

	}else{
		$form_data['success'] 	= false;
		$form_data['msg'] 		= 'Dados Invalidos';
	}
} else {
	$form_data['success'] 	= false;
	$form_data['msg'] 		= 'Requisicao Invalida';
}

Util::gerarLog($upserting,'aluno');

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');
echo json_encode($form_data);
