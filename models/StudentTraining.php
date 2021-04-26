<?php

require_once "ORMMapper.php";
require_once "Student.php";
require_once "Training.php";

class StudentTraining extends ORMMapper {
    private $tableName = 'studentTrainings';
    public $id;
    public $studentId;
    public $trainingId;
    public $status;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function findById($id)
    {
        $data = parent::findById($id);
        $training = new Training();
        $data->training = $training->findById($data->id);

        return $data;
    }

    function findByProperty($propertyName, $propertyValue)
    {
        $data = parent::findByProperty($propertyName, $propertyValue);

        foreach ($data as $d) {

            $training = new Training();
            $d->exercise = $training->findById($d->trainingId);
        }

        return $data;
    }

    function save($data = null) {
        $invalidStateMessage = null;

        if(!isset($data->trainingId))
            $invalidStateMessage = "treino associado ao estudante é obrigatório";

        if(!isset($data->studentId))
            $invalidStateMessage = "estudante associdado ao treino é obrigatório";

        if(!isset($data->status))
            $invalidStateMessage = "status da associação do treino ao aluno é obrigatória";

        if(!$invalidStateMessage) {
            if (isset($data->id))
                $this->id = $data->id;

            $this->trainingId = $data->trainingId;
            $this->studentId = $data->studentId;
            $this->status = $data->status;

            parent::save();
        }
        else
            throw new Exception($invalidStateMessage);


    }


}