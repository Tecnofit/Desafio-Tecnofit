<?php

require_once "ORMMapper.php";
require_once "TrainingExercise.php";
require_once "StudentTraining.php";

class StudentTrainingExercise extends ORMMapper {
    private $tableName = 'studentTrainingExercises';
    public $id;
    public $studentTrainingId;
    public $trainingExerciseId;
    public $status;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function findByProperty($propertyName, $propertyValue)
    {
        $data = parent::findByProperty($propertyName, $propertyValue);
        foreach ($data as $d) {
            $trainingExercise = new TrainingExercise();
            $d->trainingExercise = $trainingExercise->findById($d->trainingExerciseId);
        }

        return $data;
    }

    function save($data = null) {
        $invalidStateMessage = null;

        if(!isset($data->studentTrainingId))
            $invalidStateMessage = "treino do estudante é obrigatório para associar ao item de exercício";

        if(!isset($data->trainingExerciseId))
            $invalidStateMessage = "exercício do treino é necessário para associar ao item de exercício";

        if(!$invalidStateMessage) {
            if (isset($data->id))
                $this->id = $data->id;

            $this->studentTrainingId = $data->studentTrainingId;
            $this->trainingExerciseId = $data->trainingExerciseId;
            $this->status = $data->status;

            parent::save();
        }
        else
            throw new Exception($invalidStateMessage);


    }


}