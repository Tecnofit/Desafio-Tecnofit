<?php

require_once "ORMMapper.php";
require_once "Exercise.php";

class TrainingExercise extends ORMMapper {
    private $tableName = 'trainingExercises';
    public $id;
    public $trainingId;
    public $exerciseId;
    public $numberOfSessions;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function findById($id)
    {
        $trainingExercise = parent::findById($id);
        $exercise = new Exercise();

        // carrega dependência: exercise associado
        $trainingExercise->exercise = $exercise->findById($trainingExercise->exerciseId);

        return $trainingExercise;
    }

    function findByProperty($propertyName, $propertyValue)
    {
        $trainingExercises = parent::findByProperty($propertyName, $propertyValue);

        foreach ($trainingExercises as $trainingExercise) {
            $exercise = new Exercise();
            $trainingExercise->numberOfSessions = intval($trainingExercise->numberOfSessions);

            // carrega dependência: exercise associado
            $trainingExercise->exercise = $exercise->findById($trainingExercise->exerciseId);
        }

        return $trainingExercises;
    }

    function save($data = null) {
        $invalidStateMessage = null;

        if(!isset($data->trainingId))
            $invalidStateMessage = "treino associado é obrigatório";

        if(!isset($data->exerciseId))
            $invalidStateMessage = "exercício associado é obrigatório";

        if(!isset($data->numberOfSessions))
            $invalidStateMessage = "número sessões ao associar a um treino é obrigatório";

        if(!$invalidStateMessage) {
            if (isset($data->id))
                $this->id = $data->id;

            $this->trainingId = $data->trainingId;
            $this->exerciseId = $data->exerciseId;
            $this->numberOfSessions = $data->numberOfSessions;

            $exercise = new Exercise();

            $this->exercise = $exercise->findById($this->exerciseId);

            parent::save();
        }
        else
            throw new Exception($invalidStateMessage);


    }


}