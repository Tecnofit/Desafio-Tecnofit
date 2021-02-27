<?php
	require PATH_PROJECT . "Controllers/Controller.php";
	require PATH_PROJECT . "Services/UserServices.php";

	class AthleteController extends Controller
	{
		public function index() {

			$request["id"] = $_SESSION["user"]["id"];

			// treinos vinculados
			$list = UserServices::getTrainingsByUser($request);

			$this->view("athlete/index.php", compact("list"));
		}

		public function playTraining() {

			$request["id"] = $_POST["id"];
			$request["id_user"] = $_SESSION["user"]["id"];

			if(UserServices::playUserTraining($request)) {
				$return["result"] = true;
			} else {
				$return["result"] = false;
			}

			echo json_encode($return);
		}

		public function executeTraining() {
			$request["id_user"] = $_SESSION["user"]["id"];

			// buscar o treino ativo do atleta
			$training = UserServices::getUserTrainingActive($request);

			if(!empty($training)) {
				// buscar os exercicios referente ao atleta e treino
				$list = UserServices::getUserTrainingExercise($training);

				$currentExercise = null;
				// pegar o exercicio atual
				foreach ($list as $exercise) {
					// verificação se tem sessões a serem finalizadas e se o exercício não foi pulado
					if(empty($exercise["status"]) || $exercise["status"] == "INPROGRESS") {
						$currentExercise = $exercise;
						break;
					}
				}

				$this->view("athlete/training.php", compact("training", "currentExercise", "list"));
			}

		}

		public function finishSession() {

			$request["id_user"] = $_SESSION["user"]["id"];
			$request["id_training"] = $_POST["id_training"];
			$request["id_exercise"] = $_POST["id_exercise"];

			if(UserServices::finishSession($request)) {
				$return["result"] = true;

				// buscar o treino ativo do atleta
				$training = UserServices::getUserTrainingActive($request);

				// buscar os exercicios referente ao atleta e treino
				$list = UserServices::getUserTrainingExercise($training);

				$currentExercise = null;
				// pegar o exercicio atual
				foreach ($list as $exercise) {
					// verificação se tem sessões a serem finalizadas e se o exercício não foi pulado
					if(empty($exercise["status"]) || $exercise["status"] == "INPROGRESS") {
						$currentExercise = $exercise;
						break;
					}
				}

				$return["html"] = $this->partialView("athlete/partial/execute-training.php", compact("training", "currentExercise", "list"));
			} else {
				$return["result"] = false;
			}

			echo json_encode($return);
		}

		public function finishExercise() {

			$request["id_user"] = $_SESSION["user"]["id"];
			$request["id_training"] = $_POST["id_training"];
			$request["id_exercise"] = $_POST["id_exercise"];

			if(UserServices::finishExercise($request)) {
				$return["result"] = true;

				// buscar o treino ativo do atleta
				$training = UserServices::getUserTrainingActive($request);

				// buscar os exercicios referente ao atleta e treino
				$list = UserServices::getUserTrainingExercise($training);

				$currentExercise = null;
				// pegar o exercicio atual
				foreach ($list as $exercise) {
					// verificação se tem sessões a serem finalizadas e se o exercício não foi pulado
					if(empty($exercise["status"]) || $exercise["status"] == "INPROGRESS") {
						$currentExercise = $exercise;
						break;
					}
				}

				$return["html"] = $this->partialView("athlete/partial/execute-training.php", compact("training", "currentExercise", "list"));
			} else {
				$return["result"] = false;
			}

			echo json_encode($return);
		}

		public function skipExercise() {

			$request["id_user"] = $_SESSION["user"]["id"];
			$request["id_training"] = $_POST["id_training"];
			$request["id_exercise"] = $_POST["id_exercise"];

			if(UserServices::skipExercise($request)) {
				$return["result"] = true;

				// buscar o treino ativo do atleta
				$training = UserServices::getUserTrainingActive($request);

				// buscar os exercicios referente ao atleta e treino
				$list = UserServices::getUserTrainingExercise($training);

				$currentExercise = null;
				// pegar o exercicio atual
				foreach ($list as $exercise) {
					// verificação se tem sessões a serem finalizadas e se o exercício não foi pulado
					if(empty($exercise["status"]) || $exercise["status"] == "INPROGRESS") {
						$currentExercise = $exercise;
						break;
					}
				}

				$return["html"] = $this->partialView("athlete/partial/execute-training.php", compact("training", "currentExercise", "list"));
			} else {
				$return["result"] = false;
			}

			echo json_encode($return);
		}
	}
?>