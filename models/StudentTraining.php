<?php

require_once "ORMMapper.php";
require_once "Student.php";
require_once "StudentTrainingExercise.php";
require_once "Training.php";
require_once "TrainingExercise.php";

class StudentTraining extends ORMMapper {
    private $tableName = 'studentTrainings';
    public $id;
    public $studentId;
    public $trainingId;
    public $training;
    public $status;

    function __construct()
    {
        parent::setTableName($this->tableName);
        parent::__construct();

    }

    function findById($id)
    {
        $studentTraining = parent::findById($id);

        // carrega dependências: trainings e studentTrainingExercises associados
        $training = new Training();
        $studentTraining->training = $training->findById($studentTraining->trainingId);
        $studentTraining->studentTrainingExercises = self::getStudentTrainingExercises($studentTraining->id);
        $studentTraining->training = self::getTraining($studentTraining.$this->trainingId);

        return $studentTraining;
    }

    function findByProperty($propertyName, $propertyValue)
    {
        $studentTrainings = parent::findByProperty($propertyName, $propertyValue);

        // para cada item, carrega dependências: trainings e studentTrainingExercises associados
        foreach ($studentTrainings as $studentTraining) {

            $studentTraining->studentTrainingExercises = self::getStudentTrainingExercises($studentTraining->id);
            $studentTraining->training = self::getTraining($studentTraining->trainingId);
        }

        return $studentTrainings;
    }

    function getTraining($trainingId) {
        $training = new Training();
        return $training->findById($trainingId);
    }

    function getStudentTrainingExercises($studentTrainingId) {
        $studentTrainingExercises = array();
        $studentTrainingExercise = new StudentTrainingExercise();
        foreach ($studentTrainingExercise->findByProperty("studentTrainingId", $studentTrainingId) as $ste) {
            $studentTrainingExercises[] = $ste;        }

        return $studentTrainingExercises;
    }


    function save($data = null) {
        $invalidStateMessage = null;

        /* valida informações antes de salvar */
        if(!isset($data->trainingId))
            $invalidStateMessage = "treino associado ao estudante é obrigatório";

        if(!isset($data->studentId))
            $invalidStateMessage = "estudante associdado ao treino é obrigatório";

        if(!isset($data->status))
            $invalidStateMessage = "status da associação do treino ao aluno é obrigatória";

        if(!$invalidStateMessage) {
            $isnew = false;
            if (isset($data->id))
                $this->id = $data->id; // se tem id, é um update
            else
                $isnew = true; // senão, é insert

            $this->trainingId = $data->trainingId;
            $this->studentId = $data->studentId;
            $this->status = $data->status;

            parent::save();

            $this->training = self::getTraining($this->trainingId);

            if ($isnew) {


                $trainingExercise = new TrainingExercise();
                // busca todos os trainingExercises associados ao training que se está associando ao student
                $trainingExercises = $trainingExercise->findByProperty("trainingId", $this->trainingId);

                // para cada trainingExercises, vincula um novo studentTrainingExercise ao student
                foreach ($trainingExercises as $trainingExercise) {

                    $ste = new StudentTrainingExercise();
                    $data->trainingExerciseId = $trainingExercise->id;
                    $data->studentTrainingId = $this->id;
                    $data->status = "Pending";

                    $ste->save($data);

                }
            }

        }
        else
            throw new Exception($invalidStateMessage);


    }


}