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

    function findAll()
    {
        $trainings = parent::findAll();

        // para cada item, carrega os trainingExercises associados
        foreach ($trainings as $training) {
            $training->trainingExercises = self::getTrainingExercises($training->id);
        }

        return $trainings;

    }

    function findByProperty($propertyName, $propertyValue)
    {
        $trainings = parent::findByProperty($propertyName, $propertyValue);

        // para cada item, carrega os trainingExercises associados
        foreach ($trainings as $training) {
            $training->trainingExercises = self::getTrainingExercises($training->id);
        }

        return $trainings;
    }


    function findById($id)
    {
        $training = parent::findById($id);

        // carrega os trainingExercises associados
        $training->trainingExercises = self::getTrainingExercises($id);

        return $training;
    }

    function getTrainingExercises($trainingId) {
        $trainingExercises = array();
        $trainingExercise = new TrainingExercise();
        foreach ($trainingExercise->findByProperty("trainingId", $trainingId) as $te) {
            $trainingExercises[] = $te;
        }

        return $trainingExercises;
    }

    function save($data = null) {
        $invalidStateMessage = null;

        /* valida informações antes de salvar */
        if(!isset($data->name))
            $invalidStateMessage = "nome do treino é obrigatório";

        if(!$invalidStateMessage) {
            if (isset($data->id))
                $this->id = $data->id; // se tem id, é update

            $this->name = $data->name;

            if(!isset($data->status)) // se não tem status, atribui default
                $this->status = "Waiting";
            else
                $this->status = $data->status;

            parent::save(); // salva

            $this->trainingExercises = array();
            if (isset($data->trainingExercises)) {

                // para cada trainingExercises associado ao training, faz o salvamento
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