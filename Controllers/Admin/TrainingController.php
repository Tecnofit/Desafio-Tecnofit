<?php
	require PATH_PROJECT . "Controllers/Controller.php";
	require PATH_PROJECT . "Services/TrainingServices.php";

	class TrainingController extends Controller
	{
		public function index() {
			$list = TrainingServices::getTrainings();

			$this->view("admin/training/index.php", compact("list"));
		}

		public function getTraining() {

			$request["id"] = $_GET["id"];

			$training = TrainingServices::getTrainingById($request);

			if(isset($_GET["return"]) && $_GET["return"] == "JSON") {
				echo json_encode($training->toArray());
			}
		}

		public function getTrainingExercise() {

			$request["id"] = $_GET["id"];

			// exercicios disponiveis a vincular
			$return["listExercises"] = TrainingServices::getExercisesAvaliableByTraining($request);

			// exercicios vinculados
			$list = TrainingServices::getTrainingExerciseById($request);

			$return["htmlExercises"] = $this->partialView("admin/training/exercise-list.php", compact("list"));
			echo json_encode($return);
		}

		public function linkExercise() {

			$request["id"] = @$_POST["id"];
			$request["id_training"] = $_POST["id_training"];
			$request["id_exercise"] = $_POST["id_exercise"];
			$request["session"] = $_POST["session"];

			$result = TrainingServices::saveTrainingExercise($request);
			if ($result === true) {
				$return["result"] = true;
				$return["msg"] = "Treino salvo com sucesso.";

				$request["id"] = $request["id_training"];
				$return["listExercises"] = TrainingServices::getExercisesAvaliableByTraining($request);

				// exercicios vinculados
				$list = TrainingServices::getTrainingExerciseById($request);
				$return["htmlExercises"] = $this->partialView("admin/training/exercise-list.php", compact("list"));

				// lista geral de treinos
				$list = TrainingServices::getTrainings();
				$return["html"] = $this->partialView("admin/training/list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;
			}

			echo json_encode($return);
		}

		public function removeExercise() {

			$request["id"] = $_POST["id"];

			$result = TrainingServices::deleteTrainingExercise($request);
			if ($result === true) {
				$return["result"] = true;
				$return["msg"] = "Treino salvo com sucesso.";

				$request["id"] = $_POST["id_training"];

				$return["listExercises"] = TrainingServices::getExercisesAvaliableByTraining($request);

				// exercicios vinculados
				$list = TrainingServices::getTrainingExerciseById($request);
				$return["htmlExercises"] = $this->partialView("admin/training/exercise-list.php", compact("list"));

				// lista geral de treinos
				$list = TrainingServices::getTrainings();
				$return["html"] = $this->partialView("admin/training/list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;
			}

			echo json_encode($return);
		}

		public function save() {

			$request["id"] = $_POST["id"];
			$request["name"] = trim($_POST["name"]);

			$result = TrainingServices::saveTraining($request);
			if ($result === true) {
				$return["result"] = true;
				$return["msg"] = "Treino salvo com sucesso.";

				$list = TrainingServices::getTrainings();
				$return["html"] = $this->partialView("admin/training/list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;
			}

			echo json_encode($return);
		}

		public function removeTraining() {

			$request["id"] = $_POST["id"];

			if(TrainingServices::deleteTraining($request)) {
				$return["result"] = true;
				$return["msg"] = "Removido com sucesso.";

				$list = TrainingServices::getTrainings();
				$return["html"] = $this->partialView("admin/training/list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;;
			}

			echo json_encode($return);
		}
	}
?>