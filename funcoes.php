<?php
	session_start();

    include_once("funcoes-defines.php");
    include_once("funcoes-bd.php");
    include_once("funcoes-login.php");

	// Funções Permitidas pela API
	$arr_funcoes = array (
		"login",
		"recover",
		"redefine"
	);

	if (!empty($_POST['action'])) {
		$args = $_POST; // pega argumentos passados
		unset($args['action']); // remove action dos argumentos

		if ( function_exists($_POST['action']) && in_array( $_POST['action'] , $arr_funcoes ) ) { // se existir função e for permitida
			// pega retorno da função
			$retorno = $_POST['action']($args);
		} else {
			// erro 01 (função falsa)
			$retorno = array(
				"status" => 0,
				"msg" => "Um problema ocorreu (erro 01)"
			);
		}
		echo json_encode($retorno);
	}
	function slugarquivo($str) {
	    $str = strtolower(trim($str));
	    $str = preg_replace('/[^a-z0-9-.]/', '_', $str);
	    $str = preg_replace('/-+/', "_", $str);
	    return $str;
	}
	function datetimetostr($datetime) {
		$datetime = explode(" ",$datetime);
		$date = implode("/",array_reverse(explode("-",$datetime[0])));
		$datetimestr = $date . " " . $datetime[1];
		return $datetimestr;
	}	
?>