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
        $data = parent::findById($id);
        $exercise = new Exercise();
        $data->exercise = $exercise->findById($data->exerciseId);

        return $data;
    }

    function findByProperty($propertyName, $propertyValue)
    {
        $data = parent::findByProperty($propertyName, $propertyValue);

        foreach ($data as $d) {

            $exercise = new Exercise();
            $d->exercise = $exercise->findById($d->exerciseId);
        }

        return $data;
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

            parent::save();
        }
        else
            throw new Exception($invalidStateMessage);


    }


}