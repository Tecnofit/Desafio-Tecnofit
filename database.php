<?php
require_once ("config.php");
class Database{
 
    private $host     = DBHOST;
    private $db_name  = DBNAME;
    private $username = DBUSER;
    private $password = DBPASS;
    public  $conn;
 
    // conexao
     public function getConnection(){
        $this->conn = null; 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        } 
        return $this->conn;
    }
}
?>