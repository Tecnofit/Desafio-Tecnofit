<?php

	// Definição das rotas permitidas

	// rotas gerais
	Routes::addRoute("GET", "Controllers/IndexController.php", "index", "index");
	Routes::addRoute("GET", "Controllers/LoginController.php", "index", "login");
	Routes::addRoute("POST", "Controllers/LoginController.php", "login", "login");
	Routes::addRoute("GET", "Controllers/LoginController.php", "logout", "logout");

	// rotas relacionadas a atletas, perfil admin
	Routes::addRoute("GET", "Controllers/Admin/AthleteController.php", "index", "admin/athlete/list", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/AthleteController.php", "save", "admin/athlete/save", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/Admin/AthleteController.php", "getUser", "admin/athlete/get-user", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/AthleteController.php", "removeUser", "admin/athlete/remove-user", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/Admin/AthleteController.php", "getTrainingsByUser", "admin/athlete/get-trainings", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/AthleteController.php", "linkTraining", "admin/athlete/link-training", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/AthleteController.php", "removeTraining", "admin/athlete/remove-training", ["ADMIN"]);

	// rotas relacionadas a treinos, perfil admin
	Routes::addRoute("GET", "Controllers/Admin/TrainingController.php", "index", "admin/training/list", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/TrainingController.php", "save", "admin/training/save", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/TrainingController.php", "linkExercise", "admin/training/link-exercise", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/TrainingController.php", "removeExercise", "admin/training/remove-exercise", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/Admin/TrainingController.php", "getTraining", "admin/training/get-training", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/Admin/TrainingController.php", "getTrainingExercise", "admin/training/get-training-exercise", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/TrainingController.php", "removeTraining", "admin/training/remove-training", ["ADMIN"]);

	// rotas relacionadas a exercícios, perfil admin
	Routes::addRoute("GET", "Controllers/Admin/ExerciseController.php", "index", "admin/exercise/list", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/ExerciseController.php", "save", "admin/exercise/save", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/Admin/ExerciseController.php", "getExercise", "admin/exercise/get-exercise", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/Admin/ExerciseController.php", "removeExercise", "admin/exercise/remove-exercise", ["ADMIN"]);

	// rotas relacionadas a atletas, perfil atleta
	Routes::addRoute("GET", "Controllers/AthleteController.php", "index", "athlete/index", ["ATHLETE"]);
	Routes::addRoute("POST", "Controllers/AthleteController.php", "playTraining", "athlete/play-training", ["ATHLETE"]);
	Routes::addRoute("GET", "Controllers/AthleteController.php", "executeTraining", "athlete/execute-training", ["ATHLETE"]);

	Routes::addRoute("POST", "Controllers/AthleteController.php", "finishSession", "athlete/finish-session", ["ATHLETE"]);
	Routes::addRoute("POST", "Controllers/AthleteController.php", "finishExercise", "athlete/finish-exercise", ["ATHLETE"]);
	Routes::addRoute("POST", "Controllers/AthleteController.php", "skipExercise", "athlete/skip-exercise", ["ATHLETE"]);

?>