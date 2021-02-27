<?php

	// Definição das rotas permitidas por perfil
	Routes::addRoute("GET", "Controllers/IndexController.php", "index", "index", ["ADMIN", "ATHLETE", "NONE"]);
	Routes::addRoute("GET", "Controllers/LoginController.php", "index", "login");
	Routes::addRoute("POST", "Controllers/LoginController.php", "login", "login");

	// rotas relacionadas a atletas, para admin
	Routes::addRoute("GET", "Controllers/AthleteController.php", "index", "athlete/list", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/AthleteController.php", "save", "athlete/save", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/AthleteController.php", "getUser", "athlete/get-user", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/AthleteController.php", "removeUser", "athlete/remove-user", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/AthleteController.php", "getTrainingsByUser", "athlete/get-trainings", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/AthleteController.php", "linkTraining", "athlete/link-training", ["ADMIN"]);

	// rotas relacionadas a treinos, para admin
	Routes::addRoute("GET", "Controllers/TrainingController.php", "index", "training/list", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/TrainingController.php", "save", "training/save", ["ADMIN"]);

	Routes::addRoute("POST", "Controllers/TrainingController.php", "linkExercise", "training/link-exercise", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/TrainingController.php", "getTraining", "training/get-training", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/TrainingController.php", "getTrainingExercise", "training/get-training-exercise", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/TrainingController.php", "removeTraining", "training/remove-training", ["ADMIN"]);

	// rotas relacionadas a exercícios, para admin
	Routes::addRoute("GET", "Controllers/ExerciseController.php", "index", "exercise/list", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/ExerciseController.php", "save", "exercise/save", ["ADMIN"]);
	Routes::addRoute("GET", "Controllers/ExerciseController.php", "getExercise", "exercise/get-exercise", ["ADMIN"]);
	Routes::addRoute("POST", "Controllers/ExerciseController.php", "removeExercise", "exercise/remove-exercise", ["ADMIN"]);

?>