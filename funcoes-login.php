<?php

	// Loga usuário
	function login($args) {
		$sql = "SELECT usuari_id, usuari_nome, usuari_email, usuari_senha, usuari_tipo FROM usuario WHERE usuari_email='".$args['l_email']."' AND usuari_senha='".md5($args['l_senha'])."'";
		$rs = $_SESSION['db']->Execute($sql);
		if (empty($args['l_email']) || empty($args['l_senha'])) {
			// erro 02 (argumentos necessários em branco)
			$retorno = array(
				"status" => 0,
				"msg" => "Um problema ocorreu (erro 02)"
			);
		} elseif (!$rs->RecordCount()) {
			$retorno = array(
				"status" => 0,
				"msg" => "E-mail ou Senha incorretos."
			);
		} else {
			$row = $rs->FetchRow();
			$_SESSION['l_cod'] = $row['usuari_id'];
			$_SESSION['l_email'] = $row['usuari_email'];
			$_SESSION['l_senha'] = $row['usuari_senha'];
			$_SESSION['l_nome'] = $row['usuari_nome'];
			$_SESSION['l_tipo'] = $row['usuari_tipo'];
			$_SESSION['l_host'] = $_SERVER['HTTP_HOST'];
			$retorno = array(
				"status" => 1,
				"msg" => "Login efetuado."
			);
		}

		return $retorno;
	}

	function logged() {
		$sql = "SELECT usuari_id FROM usuario WHERE usuari_id='".$_SESSION['l_cod']."' AND usuari_email='".$_SESSION['l_email']."' AND usuari_senha='".$_SESSION['l_senha']."'";
		$rs = $_SESSION['db']->Execute($sql);
		if (!$rs->RecordCount() || $_SERVER['HTTP_HOST'] != $_SESSION['l_host']) {
			header("LOCATION: login.php");
		}
	}

	// Retorna se usuário logado
	function is_logged() {
		$sql = "SELECT usuari_id FROM usuario WHERE usuari_id='".$_SESSION['l_cod']."' AND usuari_email='".$_SESSION['l_email']."' AND usuari_senha='".$_SESSION['l_senha']."'";
		$rs = $_SESSION['db']->Execute($sql);
		if (!$rs->RecordCount() || $_SERVER['HTTP_HOST'] != $_SESSION['l_host']) {
			return false;
		} else {
			return true;
		}
	}

	function diffDate($d1, $d2, $type='', $sep='-'){
 		$d1 = explode($sep, $d1);
 		$d2 = explode($sep, $d2);
 		switch ($type){
 			case 'A':
 				$X = 31536000;
 				break;
 			case 'M':
 				$X = 2592000;
 				break;
 			case 'D':
 				$X = 86400;
 				break;
 			case 'H':
 				$X = 3600;
 				break;
 			case 'MI':
 				$X = 60;
 				break;
 			default:
 				$X = 1;
 		}
 		return floor((mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]) - mktime(0, 0, 0, $d1[1], $d1[2], $d1[0]))  / $X) ;
 	}
