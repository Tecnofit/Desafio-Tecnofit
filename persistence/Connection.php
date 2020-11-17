<?php

require "../constants.php";

class Connection
{

    public static $instance;

    private $connection;

    private $dbhost = MYSQL_HOST;
    private $dbname = DATABASE_ACADEMIA;
    private $dbuser = MYSQL_ROOT_USER;
    private $dbpass = MYSQL_ROOT_PASS;

    public function __construct()
    {
        //$this->connection = new PDO('mysql:host=' . $this->dbhost . ';dbname=' . $this->dbname, $this->dbuser, $this->dbpass);
        $this->connection = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if ($this->connection->connect_errno) {
            echo "Failed to connect to MySQL: " . $this->connection->connect_error;
            exit();
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function errorConnections()
    {
        if($this->getConnection()->errno>0){
            return $this->getConnection()->error;
        }
        return false;
    }

}