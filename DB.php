<?php

	class DB{
		private $dbHost = "localhost";
		private $dbUsername = "root";
		private $dbPassword = "";
		private $dbName = "tecnofit";
		
		public function __construct(){
			if(!isset($this->db)){
				// Conecta ao banco
				$conn = new mysqli($this->dbHost, $this->dbUsername, $this->dbPassword, $this->dbName);
				if($conn->connect_error){
					die("Falha ao tentar conectar com o banco de dados: " . $conn->connect_error);
				}
				else{
					$this->db = $conn;
				}
			}
		}
		
		public function getRowById($id, $table){
			$sql = "SELECT * FROM $table WHERE id = $id";
			$result = $this->db->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					$data[] = $row;
				}
			}
			return !empty($data)?$data[0]:false;
		}

		public function getRows($table, $conditions = array()){
			$sql = 'SELECT ';
			$sql .= array_key_exists("select", $conditions)?$conditions['select']:'*';
			$sql .= ' FROM '.$table;
			if(array_key_exists("where", $conditions)){
				$sql .= ' WHERE ';
				$i = 0;
				foreach($conditions['where'] as $key => $value){
					$pre = ($i > 0)?' AND ':'';
					$sql .= $pre.$key." = '".$value."'";
					$i++;
				}
			}
			
			if(array_key_exists("order_by", $conditions)){
				$sql .= ' ORDER BY '.$conditions['order_by']; 
			}
			
			if(array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)){
				$sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit']; 
			}
			elseif(!array_key_exists("start", $conditions) && array_key_exists("limit", $conditions)){
				$sql .= ' LIMIT '.$conditions['limit']; 
			}
			
			$result = $this->db->query($sql);
			
			if(array_key_exists("return_type", $conditions) && $conditions['return_type'] != 'all'){
				switch($conditions['return_type']){
					case 'count':
						$data = $result->num_rows;
						break;
					case 'single':
						$data = $result->fetch_assoc();
						break;
					default:
						$data = '';
				}
			}
			else{
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						$data[] = $row;
					}
				}
			}
			return !empty($data)?$data:false;
		}
		
        public function execute($sql){
		    return $this->db->query($sql);
        }
	}