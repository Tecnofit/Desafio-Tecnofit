<?php
namespace Tecno;
require_once '../vendor/autoload.php';

use Tecno\Back\RouteController;

class api extends RouteController
{
    protected $routes = [
        'GET' => [
            'get-all-profiles' => '\Tecno\Back\Api\StudentApi@getAllProfiles',
            'get-all-training' => '\Tecno\Back\Api\TrainingApi@getAllTraining',
            'get-all-traininglvl' => '\Tecno\Back\Api\TrainingApi@getAllLevels',
            'get-all-exercises' => '\Tecno\Back\Api\ExerciseApi@getAllExercises',
            'get-all-students' => '\Tecno\Back\Api\StudentApi@getAllStudents',
            'get-students-by' => '\Tecno\Back\Api\StudentApi@getStudentById',
            'get-exercise-by' => '\Tecno\Back\Api\ExerciseApi@getExerciseById',
            'get-training-by' => '\Tecno\Back\Api\TrainingApi@getTrainingById',
            'get-training-by-student' => '\Tecno\Back\Api\TrainingApi@getTrainingByStudent',
            'get-exercises-by-training' => '\Tecno\Back\Api\ExerciseApi@getExerciseByTraining',
            'get-students-training' => '\Tecno\Back\Api\StudentApi@getStudentTraining',
            
            
        ],
        'POST' => [
            'save-exercise' => '\Tecno\Back\Api\ExerciseApi@saveExercise',
            'save-training' => '\Tecno\Back\Api\TrainingApi@saveTraining',
            'save-student' => '\Tecno\Back\Api\StudentApi@saveStudent',
            'complete-training' => '\Tecno\Back\Api\StudentApi@completeTraining',
        ],
        'PUT' => [
        ],
        'DELETE' => [
            'delete-training' => '\Tecno\Back\Api\TrainingApi@deleteTraining',
            'delete-student' => '\Tecno\Back\Api\StudentApi@deleteStudent',
            'delete-exercise' => '\Tecno\Back\Api\ExerciseApi@deleteExercise',
        ]
    ];

    public function run()
    {
        $toExecute = $this->getClassMethod();
        $class = $toExecute[0];
        $method = $toExecute[1];
        return $class::$method($this->params());
    }
}

$api = new api();
$api->run();
