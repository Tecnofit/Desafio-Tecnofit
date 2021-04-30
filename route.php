<?php

// MODELS
require_once("models/Student.php");
require_once("models/Exercise.php");
require_once("models/Training.php");
require_once("models/TrainingExercise.php");
require_once("models/StudentTraining.php");
require_once("models/StudentTrainingExercise.php");

// se $_GET["entityName"]
if(isset($_GET["entityName"])) {

    $response = "";

    // obtem o model específico
    $entityModel = getEntityModel($_GET["entityName"]);

    /*
        De acordo com algum outro parametro recebido no get, procede com alguma chama específica do model:

            - não há parametros extras: getAll (listagem geral)
            - studentId, trainingId, studentTrainingId: getByProperty (listagem específica)
            - id: getById

    */

    if(isset($_GET["id"])) {
        $response = json_encode($entityModel->findById($_GET["id"]));
    }
    else if(isset($_GET["studentId"])) {
        $response = json_encode($entityModel->findByProperty("studentId", $_GET["studentId"]));
    }
    else if(isset($_GET["trainingId"])) {
        $response = json_encode($entityModel->findByProperty("trainingId", $_GET["trainingId"]));
    }
    else if(isset($_GET["studentTrainingId"])) {
        $response = json_encode($entityModel->findByProperty("studentTrainingId", $_GET["studentTrainingId"]));
    }
    else {
        $response = json_encode($entityModel->findAll());
    }

    echo $response;
}
// POST
else {
    try {
        $jsonString = file_get_contents('php://input');

        // caso tenha recebido um json no POST
        if (strlen($jsonString)) {
            $data = json_decode($jsonString); // tranforma em objeto

            // se possui entityName e action, procede
            if (isset($data->entityName) && isset($data->action)) {
                // obtem o model específico
                $entityModel = getEntityModel($data->entityName);
                if($entityModel != null) {

                    // se 'save' ou 'delete, delega ação para o model específico resolver
                    if ($data->action == "save") {
                        $entityModel->save($data);
                        header("Status: 200");
                        echo json_encode($entityModel);

                    } else if ($data->action == "delete") { // se delete
                        $entityModel->delete($data);
                    }
                }

            }

        }
    }
    catch(Exception $e) { // cao haja alguma exeção de servidor ou validação de dados, retorna 500
        header("HTTP/1.1 500 Internal Server Error");
        echo $e->getMessage();
    }
}

// declarando o model especifico a ser usado de acordo com o nome recebido no GET ou POST
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
