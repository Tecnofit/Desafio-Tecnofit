<?php
	require PATH_PROJECT . "Controllers/Controller.php";
	require PATH_PROJECT . "Services/UserServices.php";

	class IndexController extends Controller
	{
		public function index() {

			// verificação usuario logado
			if(isset($_SESSION["user"])) {
				// print_r($_SESSION["user"]);
				if(isset($_SESSION["user"]["profile"]) && $_SESSION["user"]["profile"] == "ADMIN") {
					$this->view("admin/index.php");
				} else if(isset($_SESSION["user"]["profile"]) && $_SESSION["user"]["profile"] == "ATHLETE") {
					$this->view("athlete/index.php");
				}
			} else {
				$this->simpleView("login/index.php");
			}

		}
	}
?>