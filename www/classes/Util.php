<?php
class Util
{
	public static function tratar($texto)
	{
		$texto = trim($texto);
		$texto = stripslashes($texto);
		// Retira tags HTML
		$texto = strip_tags($texto);
		// Substitui aspas duplas
		$texto = str_replace('"', '&quot;', $texto);
		$texto = str_replace(chr(147), '&quot;', $texto);
		$texto = str_replace(chr(148), '&quot;', $texto);
		// Substitui aspas simples
		$texto = str_replace("'", "&#039;", $texto);
		// Tira uma aspas simples
		$texto = str_replace("&#039;&#039;", "&#039;", $texto);
		return ($texto);
	}

	public static function tratarNum($texto)
	{
		$textoNovo = '';
		$texto = trim($texto);
		$texto = strip_tags($texto);
		$texto = preg_replace('/[\n|\r|\n\r|\r\n]{2,}/', ' ', $texto); //remove

		$qtd = strlen($texto);
		$abc = "0123456789";
		for ($i = 0; $i < $qtd; $i++) {
			$letra = substr($texto, $i, 1);
			if (stristr($abc, $letra)) {
				$textoNovo = $textoNovo . $letra;
			}
		}

		return ($textoNovo);
	}

	public static function gerarLog($processado,$nmFile)
	{
		$dados = "TESTE\n";
		$dados .= 'POST<pre>' . print_r($_POST, 1) . '</pre>';
		$dados .= 'GET<pre>' . print_r($_GET, 1) . '</pre>';
		$dados .= 'PROCESSADO<pre>' . print_r($processado, 1) . '</pre>';
	
		$fileName    = 'treino_' . date('H') . 'h' . date('i') . 'm' . date('i') . 's.html';
		$diretorio = '../log';
		$caminho = $diretorio.'/' . $fileName;
	
		if (file_exists($caminho)) {
		} else {
			$tipo = 'xb';
		}
	
		$handle = fopen($caminho, $tipo);
		fwrite($handle, $dados);
	
		fclose($handle);
	
	
		// REMOVER OS ARQUIVOS ANTIGOS
		$dataRetro = date('Ymd', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y'))); // DEFINE DIAS ATRAS DE ARMAZENAMENTO
		if ($handle = opendir($diretorio)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					//$arrF = explode("_",$entry);
					$dtFile = explode('-', $entry);
					//$dtFile = explode('_',$dtFile[0]);
					//ECHO ($dtFile[1].'<'.$dataRetro).'<BR>';
					if ($dtFile[0] < $dataRetro) {
						unlink($diretorio . $entry);
					}
				}
			}
			closedir($handle);
		}
	}
}
