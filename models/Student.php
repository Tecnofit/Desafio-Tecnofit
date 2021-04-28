<?php

require_once "ORMMapper.php";

class Student extends ORMMapper {
    private $tableName = 'students';
    public $id = null;
    public $name = null;
    public $email = null;
    public $phoneNumber = null;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function save($data = null) {
        $invalidStateMessage = null;
        if(!isset($data->name))
            $invalidStateMessage = "nome do estudante é obrigatório";

        if(!isset($data->email))
            $invalidStateMessage = "email do estudante é obrigatório";

        if(!isset($data->phoneNumber))
            $invalidStateMessage = "telefone do estudante é obrigatório";

        if(!$invalidStateMessage) {
            if (isset($data->id))
                $this->id = $data->id;

            $this->name = $data->name;
            $this->email = $data->email;
            $this->phoneNumber = $data->phoneNumber;
            parent::save();
        }
        else
            throw new Exception($invalidStateMessage);

    }

}