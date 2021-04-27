<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("models/Student.php");
require_once("models/Exercise.php");
require_once("models/Training.php");
require_once("models/TrainingExercise.php");
require_once("models/StudentTraining.php");
require_once("models/StudentTrainingExercise.php");

if(isset($_GET["entityName"])) {

    $entityModel = getEntityModel($_GET["entityName"]);

    if(isset($_GET["id"]))
        echo json_encode($entityModel->findById($_GET["id"]));
    else if(isset($_GET["studentId"]))
        echo json_encode($entityModel->findByProperty("studentId", $_GET["studentId"]));
    else if(isset($_GET["trainingId"]))
        echo json_encode($entityModel->findByProperty("trainingId", $_GET["trainingId"]));
    else if(isset($_GET["studentTrainingId"]))
        echo json_encode($entityModel->findByProperty("studentTrainingId", $_GET["studentTrainingId"]));
    else
        echo json_encode($entityModel->findAll());

}

else {
    try {
        $jsonString = file_get_contents('php://input');

        if (strlen($jsonString)) {
            $data = json_decode($jsonString);

            if (isset($data->entityName) && isset($data->action)) {
                $entityModel = getEntityModel($data->entityName);

                if($entityModel != null) {
                    if ($data->action == "save") {

                        $entityModel->save($data);
                        header("Status: 200");

                        echo json_encode($entityModel);

                    } else if ($data->action == "delete") {
                        $entityModel->delete($data);
                    }
                }
            }

        }
    }
    catch(Exception $e) {
        header("HTTP/1.1 500 Internal Server Error");
        echo $e->getMessage();
    }
}

function getEntityModel($entityName) {
    $entityModel = null;
    switch ($entityName) {
        case "students": $entityModel = new Student(); break;
        case "exercises": $entityModel = new Exercise(); break;
        case "trainings": $entityModel = new Training(); break;
        case "trainingExercises": $entityModel = new TrainingExercise(); break;
        case "studentTrainings": $entityModel = new StudentTraining(); break;
        case "studentTrainingExercises": $entityModel = new StudentTrainingExercise(); break;
    }

    return $entityModel;
}
