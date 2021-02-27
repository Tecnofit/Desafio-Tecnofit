<?php
	class Controller
	{
		public function view($view, $data = []) {
			include PATH_PROJECT . "Views/layout/main.php";
		}

		public function simpleView($view, $data = []) {
			include PATH_PROJECT . "Views/layout/page.php";
		}

		public function partialView($view, $data = []) {
			ob_start();
			include PATH_PROJECT . "Views/" . $view;
	        return ob_get_clean();
		}
	}
?>