<?php
namespace Tecno\Lib;

class DB extends \PDO
{
    protected $con;
    protected $config = [];

    public function __construct()
    {
        $this->config = (include '../back/conf/database.php');
        parent::__construct("mysql:host={$this->config['host']};dbname={$this->config['dbname']}", $this->config['user'], $this->config['passwd']);
    }
}