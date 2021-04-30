<?php

require_once "ORMMapper.php";
require_once "StudentTraining.php";

class Student extends ORMMapper {
    private $tableName = 'students';
    public $id;
    public $name;
    public $email;
    public $phoneNumber;
    public $studentTrainings;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function findById($id)
    {
        $student = parent::findById($id);

        // carrega dependências: os trainings associados ao student
        $student->studentTrainings = array();
        $studentTrainings = new StudentTraining();
        foreach ($studentTrainings->findByProperty("studentId", $student->id) as $studentTraining) {
            $student->studentTrainings[] = $studentTraining;
        }
        return $student;
    }


    function save($data = null) {
        $invalidStateMessage = null;

        /* valida informações antes de salvar */
        if(!isset($data->name))
            $invalidStateMessage = "nome do estudante é obrigatório";

        if(!isset($data->email))
            $invalidStateMessage = "email do estudante é obrigatório";

        if(!isset($data->phoneNumber))
            $invalidStateMessage = "telefone do estudante é obrigatório";

        if(!$invalidStateMessage) {
            if (isset($data->id))
                $this->id = $data->id; // se tem id, é update

            $this->name = $data->name;
            $this->email = $data->email;
            $this->phoneNumber = $data->phoneNumber;
            parent::save();

            // salva os trainings associados a partir de chamada ao model específico
            foreach ($data->studentTrainings as $studentTraining) {

                $st = new StudentTraining();
                if (isset($studentTraining->id) && $studentTraining->id > 0)
                    $st->id = $studentTraining->id; // se tem id, é update

                $studentTraining->studentId = $this->id;
                $st->save($studentTraining);
                $this->studentTrainings[] = $st;
            }


        }
        else
            throw new Exception($invalidStateMessage);

    }

}