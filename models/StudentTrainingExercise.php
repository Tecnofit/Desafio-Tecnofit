<?php

require_once "ORMMapper.php";
require_once "TrainingExercise.php";
require_once "Exercise.php";

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
        $studentTrainingExercises = parent::findByProperty($propertyName, $propertyValue);

        // para cada item, carrega dependências: trainingExercise associado
        foreach ($studentTrainingExercises as $studentTrainingExercise) {
            $trainingExercise = new TrainingExercise();
            $studentTrainingExercise->trainingExercise = $trainingExercise->findById($studentTrainingExercise->trainingExerciseId);

        }

        return $studentTrainingExercises;
    }

    function save($data = null) {
        $invalidStateMessage = null;

        if(!isset($data->studentTrainingId))
            $invalidStateMessage = "treino do estudante é obrigatório para associar ao item de exercício";

        if(!isset($data->trainingExerciseId))
            $invalidStateMessage = "exercício do treino é necessário para associar ao item de exercício";

        if(!$invalidStateMessage) {
            if (isset($data->id))
                $this->id = $data->id; // se tem id, é update

            $this->studentTrainingId = $data->studentTrainingId;
            $this->trainingExerciseId = $data->trainingExerciseId;
            $this->status = $data->status;

            parent::save();
        }
        else
            throw new Exception($invalidStateMessage);


    }


}