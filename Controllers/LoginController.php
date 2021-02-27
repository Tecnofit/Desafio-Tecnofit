<?php
	require PATH_PROJECT . "Controllers/Controller.php";
	require PATH_PROJECT . "Services/UserServices.php";

	class LoginController extends Controller
	{
		public function index() {
			$this->simpleView("login/index.php");
		}

		public function login() {

			$request["login"] = $_POST["login"];
			$request["pass"] = md5($_POST["pass"]);

			if (UserServices::checkLogin($request) === true) {
				if($_SESSION["user"]["profile"] == "ADMIN") {
					header("Location: " . BASE_PROJECT . "admin/athlete/list");
				} else {
					// redireciona para a página inicial
					header("Location: index");
				}
			}
		}

		public function logout() {

			// remover sessão do usuário
			if (isset($_SESSION["user"])) {
				unset($_SESSION["user"]);
			}
			header("Location: index");
		}
	}
?>