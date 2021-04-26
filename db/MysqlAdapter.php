<?php

require_once dirname(__FILE__) ."/../interfaces/DatabaseInterface.php";

class MysqlAdapter implements DatabaseInterface
{
    private $host;
    private $username;
    private $password;
    private $dbName;
    private $port;
    private $socket;
    private $_mysqli;

    function __construct()
    {
        $connectionConfig = parse_ini_file('config.ini', true);

        $this->host = $connectionConfig["host"] ;
        $this->username = $connectionConfig["username"];
        $this->password = $connectionConfig["password"];
        $this->dbName = $connectionConfig["dbname"];
        $this->port = null;
        $this->socket = null;
    }

    function connect()
    {
        $this->_mysqli = new mysqli($this->host, $this->username, $this->password, $this->dbName, $this->socket);
        if ($this->_mysqli->connect_error) {
            return false;
        }
        return true;
    }

    function disconnect()
    {
        if (isset($this->_mysqli)) {
            $this->_mysqli->close();
        }
    }

    function insert($tableName, $columns, $values)
    {
        $insertValues = [];

        foreach ($columns as $index => $column) {
            if($column == "id" || !$values[$column])
                unset($columns[$index]);
            else
                $insertValues[] = $values[$column];
        }

        foreach ($columns as $index => $column) {
            if($column == "createdAt" || $column == "modifiedAt" || $column == "deletedAt")
                unset($columns[$index]);
        }

        $columns[] = "createdAt";
        $columns[] = "modifiedAt";
        $insertValues[] = date("Y-m-d H:i:s");
        $insertValues[] = date("Y-m-d H:i:s");


        $query = "INSERT INTO $tableName (".implode(",", $columns).") VALUES ('".implode("','", $insertValues)."')";

        if($this->_mysqli->query($query))
            return $this->_mysqli->insert_id;
        else
            throw new Exception("falha ao inserir novo registro: " . $this->_mysqli->error);

    }

    function update($tableName, $columns, $values, $conditions)
    {
        $updateValues = [];

        foreach ($columns as $index => $column) {
            $updateValues[] = $values[$column];
        }

        foreach ($columns as $index => $column) {
            if($column == "createdAt" || $column == "modifiedAt" || $column == "deletedAt") {
                unset($columns[$index]);
                unset($updateValues[$index]);

                $columns = array_values($columns);
                $updateValues = array_values($updateValues);
            }
        }
        $columns[] = "modifiedAt";
        $updateValues[] = date("Y-m-d H:i:s");


        $updateString = $this->generateUpdateString($columns, $updateValues);
        $whereString = $this->generateWhereString($conditions);
        $query = "UPDATE $tableName SET  $updateString WHERE  $whereString";

        if($this->_mysqli->query($query))
            return true;
        else
            throw new Exception("falha ao atualizar registro: " . $this->_mysqli->error);

    }

    function getTableColuns($tableName) {
        return $this->_mysqli->query("SELECT * FROM $tableName LIMIT 1");
    }

    function select($tableName, $columns, $conditions, $limit = null, $offset = null)
    {
        $query = "SELECT $columns FROM $tableName";
        if (!empty($conditions)) {
            $whereString = $this->generateWhereString($conditions);
            $query .= " WHERE $whereString";
        }
        if (isset($limit) && isset($offset)) {
            $query .= "LIMIT $limit OFFSET $offset";
        }

        $result = $this->_mysqli->query($query);
        $response = [];

        if($result){
            $response['fields'] = $this->fetchFields($result);
            $response['values'] = mysqli_fetch_all($result);
        }

        return $response;
    }

    function delete($tableName, $conditions)
    {
        $whereString = $this->generateWhereString($conditions);
        $query = "UPDATE $tableName SET deletedAt = '".date("Y-m-d H:i:s")."' WHERE $whereString";

        if($this->_mysqli->query($query))
            return true;
        else
            throw new Exception("falha ao exluir registro: " . $this->_mysqli->error);
    }

    function generateUpdateString($keys, $values)
    {
        $len = count($keys);
        $buildString = [];
        for ($i = 0; $i <= $len - 1; $i++) {

            if($values[$i] != null && $keys[$i] != "id") {
                $buildString[] = $keys[$i] . "= '" . $values[$i] . "'";
            }

        }

        return implode(",", $buildString);
    }

    public function generateWhereString($arrayValues)
    {
        $buildString = '';
        foreach ($arrayValues as $key => $arrayValue) {
            $buildString .= $key . $arrayValue[0] . $arrayValue[1] . " " . $arrayValue[2];
        }
        return $buildString;
    }

    function fetchFields($queryResult)
    {

        if ($queryResult) {

            $fieldsData = $queryResult->fetch_fields();
            $fields = [];
            foreach ($fieldsData as $fieldData) {
                $fields[] = $fieldData->name;
            }
            return $fields;
        }
        return [];
    }
}