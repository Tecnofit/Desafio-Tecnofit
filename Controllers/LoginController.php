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
			$request["pass"] = $_POST["pass"];
			// $request["pass"] = md5($_POST["pass"]);
			// $request["pass"] = "";

			if (UserServices::checkLogin($request) === true) {
				// redireciona para a página inicial
				header("Location: index");
			}
		}
	}
?>