<?php

require_once "ORMMapper.php";
require_once "Training.php";

class Exercise extends ORMMapper {
    private $tableName = 'exercises';
    public $id = null;
    public $name = null;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function delete($data = null)
    {
        $trainingModel = new Training();

        $trainings = $trainingModel->findByProperty("status", "'Active'");

        foreach ($trainings as $training) {

            foreach ($training->trainingExercises as $trainingExercise) {

                if($trainingExercise->exerciseId == $data->id)
                    throw new Exception('não é possível excluir um exercício que faz parte de um treino ativo');

            }
        }

        return parent::delete($data);
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