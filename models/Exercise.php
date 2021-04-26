<?php

require_once "ORMMapper.php";

class Exercise extends ORMMapper {
    private $tableName = 'exercises';
    public $id = null;
    public $name = null;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function save($data = null) {

        if(!isset($data->name))
            throw new Exception('nome do exercício é obrigatório');

        if(isset($data->id))
            $this->id = $data->id;

        $this->name = $data->name;
        parent::save();

    }

}