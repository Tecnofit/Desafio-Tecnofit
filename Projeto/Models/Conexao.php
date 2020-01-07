<?php

class Conexao {
	private $host     = "localhost";
	private $database = "tecnofit";
	private $usuario  = "root";
	private $senha    = "";
	public  $mysqli;

	public function __construct(){
		$this->mysqli = new mysqli($this->host, $this->usuario, $this->senha, $this->database);

		if ($this->mysqli->connect_error) {
			die("Falha na Conexao: " . $mysqli->connect_error);
		}
	}
}

