<?php
	require PATH_PROJECT . "Controllers/Controller.php";
	require PATH_PROJECT . "Services/ExerciseServices.php";

	class ExerciseController extends Controller
	{
		public function index() {
			$list = ExerciseServices::getExercises();

			$this->view("admin/exercise/index.php", compact("list"));
		}

		public function getExercise() {

			$request["id"] = $_GET["id"];

			$exercise = ExerciseServices::getExerciseById($request);

			if(isset($_GET["return"]) && $_GET["return"] == "JSON") {
				echo json_encode($exercise->toArray());
			}
		}

		public function save() {

			$request["id"] = $_POST["id"];
			$request["name"] = trim($_POST["name"]);

			$result = ExerciseServices::saveExercise($request);
			if ($result === true) {
				$return["result"] = true;
				$return["msg"] = "Exercício salvo com sucesso.";

				$list = ExerciseServices::getExercises();
				$return["html"] = $this->partialView("admin/exercise/list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;
			}

			echo json_encode($return);
		}

		public function removeExercise() {

			$request["id"] = $_POST["id"];

			if(ExerciseServices::deleteExercise($request)) {
				$return["result"] = true;
				$return["msg"] = "Removido com sucesso.";

				$list = ExerciseServices::getExercises();
				$return["html"] = $this->partialView("admin/exercise/list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;;
			}

			echo json_encode($return);
		}
	}
?>