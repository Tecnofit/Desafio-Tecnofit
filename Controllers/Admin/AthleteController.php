<?php
	require PATH_PROJECT . "Controllers/Controller.php";
	require PATH_PROJECT . "Services/UserServices.php";

	class AthleteController extends Controller
	{
		public function index() {
			$list = UserServices::getUsersByProfile("ATHLETE");

			$this->view("admin/athlete/index.php", compact("list"));
		}

		public function getUser() {

			$request["id"] = $_GET["id"];

			$user = UserServices::getUserById($request);

			if(isset($_GET["return"]) && $_GET["return"] == "JSON") {
				echo json_encode($user->toArray());
			}
		}

		public function getTrainingsByUser() {

			$request["id"] = $_GET["id"];

			// treinos disponiveis a vincular
			$return["listTrainings"] = UserServices::getTrainingsAvaliableByUser($request);

			// treinos vinculados
			$list = UserServices::getTrainingsByUser($request);

			$return["htmlTrainings"] = $this->partialView("admin/athlete/training-list.php", compact("list"));
			echo json_encode($return);
		}

		public function linkTraining() {

			$request["id"] = @$_POST["id"];
			$request["id_user"] = $_POST["id_user"];
			$request["id_training"] = $_POST["id_training"];

			$result = UserServices::saveUserTraining($request);
			if ($result === true) {
				$return["result"] = true;
				$return["msg"] = "Treino salvo com sucesso.";

				$request["id"] = $request["id_user"];
				// treinos disponiveis a vincular
				$return["listTrainings"] = UserServices::getTrainingsAvaliableByUser($request);

				// treinos vinculados
				$list = UserServices::getTrainingsByUser($request);

				$return["htmlTrainings"] = $this->partialView("admin/athlete/training-list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;
			}

			echo json_encode($return);
		}

		public function removeTraining() {

			$request["id"] = $_POST["id"];
			$request["id_user"] = $_POST["id_user"];

			$result = UserServices::deleteUserTraining($request);
			if ($result === true) {
				$return["result"] = true;
				$return["msg"] = "Treino salvo com sucesso.";

				$request["id"] = $request["id_user"];
				// treinos disponiveis a vincular
				$return["listTrainings"] = UserServices::getTrainingsAvaliableByUser($request);

				// treinos vinculados
				$list = UserServices::getTrainingsByUser($request);

				$return["htmlTrainings"] = $this->partialView("admin/athlete/training-list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;
			}

			echo json_encode($return);
		}

		public function save() {

			$request["id"] = $_POST["id"];
			$request["name"] = trim($_POST["name"]);
			$request["login"] = trim($_POST["login"]);
			$request["pass"] = md5(trim($_POST["pass"]));

			$result = UserServices::saveUser($request);
			if ($result === true) {
				$return["result"] = true;
				$return["msg"] = "Atleta salvo com sucesso.";

				$list = UserServices::getUsersByProfile("ATHLETE");
				$return["html"] = $this->partialView("admin/athlete/list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;
			}

			echo json_encode($return);
		}

		public function removeUser() {

			$request["id"] = $_POST["id"];

			if(UserServices::deleteUser($request)) {
				$return["result"] = true;
				$return["msg"] = "Removido com sucesso.";

				$list = UserServices::getUsersByProfile("ATHLETE");
				$return["html"] = $this->partialView("admin/athlete/list.php", compact("list"));
			} else {
				$return["result"] = false;
				$return["msg"] = $result;;
			}

			echo json_encode($return);
		}
	}
?>