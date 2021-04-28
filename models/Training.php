<?php

require_once "ORMMapper.php";
require_once "TrainingExercise.php";

class Training extends ORMMapper {

    private $tableName = 'trainings';
    public $id;
    public $name;
    public $status;
    public $trainingExercises;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function findById($id)
    {
        $data = parent::findById($id);

        $trainingExercise = new TrainingExercise();
        foreach ($trainingExercise->findByProperty("trainingId", $id) as $trainingExercise) {

            $data->trainingExercises[] = $trainingExercise;
        }

        return $data;
    }

    function save($data = null) {
        $invalidStateMessage = null;
        if(!isset($data->name))
            $invalidStateMessage = "nome do treino é obrigatório";

        if(!$invalidStateMessage) {
            if (isset($data->id))
                $this->id = $data->id;

            $this->name = $data->name;

            if(!isset($data->status))
                $this->status = "Waiting";
            else
                $this->status = $data->status;

            parent::save();

            if (isset($data->trainingExercises)) {
                foreach ($data->trainingExercises as $te) {

                    $te->trainingId = $this->id;
                    $trainingExercise = new TrainingExercise();
                    $trainingExercise->save($te);
                    $te->id = $trainingExercise->id;
                    $this->trainingExercises[] = $trainingExercise;


                }
            }
        }
        else
            throw new Exception($invalidStateMessage);

    }
}