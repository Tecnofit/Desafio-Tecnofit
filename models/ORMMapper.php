<?php


require_once dirname(__FILE__) . "/../interfaces/MapperInterface.php";
require_once dirname(__FILE__) . "/../db/MysqlAdapter.php";

class ORMMapper implements MapperInterface
{

    private $_tableName = '';

    private $_adapter;

    function __construct()
    {
        $this->_adapter = new MysqlAdapter();
        if (!$this->_adapter->connect()) {
            throw new Exception('falha ao conectar com a base de dados');
        }
        $this->loadClassProperties();
    }

    function findAll()
    {
        $result = $this->_adapter->select($this->_tableName, '*', ['deletedAt' => [' IS ', 'NULL', '']]);
        return $this->buildResponseObject($result);
    }

    function findById($id)
    {
        $result = $this->_adapter->select($this->_tableName, '*', ['id' => ['=', $id, '']]);
        $result = $this->buildResponseObject($result);

        if ($result){
            return $result[0];
        }
        return (object)[];
    }

    function findByProperty($propertyName, $propertyValue)
    {
        $result = $this->_adapter->select($this->_tableName, '*', [$propertyName => ['=', $propertyValue, '']]);
        return $this->buildResponseObject($result);

    }

    function save($data = null)
    {
        $fields = $this->_adapter->fetchFields($this->_adapter->getTableColuns($this->_tableName));
        if (isset($this->id) && $this->id != null)
            $this->_adapter->update($this->_tableName, $fields, (array)$this, ['id' => ['=', $this->id, '']]);
        else
            $this->id = $this->_adapter->insert($this->_tableName, $fields, (array)$this);

    }

    function delete($data = null) {

        if(!isset($data->id))
            throw new Exception('para exluir um registro, é necessário informar seu id');

        $this->id = $data->id;

        return $this->_adapter->delete($this->_tableName, ['id' => ['=', $this->id, '']]);
    }

    function loadClassProperties()
    {
        $fields = $this->_adapter->fetchFields($this->_adapter->getTableColuns($this->_tableName));

        foreach ($fields as $field) {
            $this->$field = null;
        }
    }

    function buildResponseObject($result)
    {
        $response = [];
        if ($result) {
            $fields = $result['fields'];
            $values = $result['values'];
            $num_of_rows = count($result['values']);
            $num_of_fields = count($result['fields']);

            $buildResponse = [];
            for ($i = 0; $i < $num_of_rows; $i++) {
                for ($j = 0; $j < $num_of_fields; $j++) {
                    $buildResponse[$fields[$j]] = $values[$i][$j];
                }
                $response[] = $buildResponse;
            }
        }
        return json_decode(json_encode($response));
    }

    public function setTableName($tableName)
    {
        $this->_tableName = $tableName;
    }
}