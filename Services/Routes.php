<?php
	require_once PATH_PROJECT . "Models/Route.php";

	class Routes
	{
		private static $routes;

		public static function mapRoutes() {
			self::$routes = array();
			require_once PATH_PROJECT . "routes.php";
		}

		public static function addRoute($type, $controller, $action, $name, $permission = []) {
			$route = new Route($type, $controller, $action, $name, $permission);

			array_push(self::$routes, $route);
		}

		public static function checkRoute() {
			// echo "<pre>;"; print_r($_SERVER);

			// Buscar link acessado
			$request = $_SERVER["DOCUMENT_ROOT"] . $_SERVER["REQUEST_URI"];
			$request = str_replace(PATH_PROJECT, "", $request);


			// Caso esteja no / ou index do projeto, retornar index
			if($request == "") {
				$routeName = "index";
			} else {

				// remover possiveis parametros get
				$request = explode('?', $request, 2);
				$request = $request[0];

				// quebrar rota e pegar apenas o possivel controller e action
				$request = explode("/", $request);
				if(count($request) == 1) {
					$routeName = $request[0];
				} else {
					$routeName = $request[0] . "/" . $request[1];
				}
			}

			// Checagem se a rota existe e foi definida com nome e tipo acessado e o perfil de acesso
			$requestType = $_SERVER['REQUEST_METHOD'];
			$profile = "NONE";
			if(isset($_SESSION['user']) && isset($_SESSION["user"]["profile"])) {
				// verificação usuario logado
				$profile = $_SESSION["user"]["profile"];
			}
			foreach (self::$routes as $route) {
				if($route->getName() == $routeName && $route->getType() == $requestType && (count($route->getProfile()) == 0 || in_array($profile, $route->getProfile()))) {
					//  && in_array($profile, $route->getProfile())
					// checagem da rota com o perdil de acesso
					return $route;
				}
			}

			print_r($requestType);
			print_r($routeName);

			// caso não tenha econtrado a routa especifica, retorna como página não encontrada
			die("404 pagina não encontrada");
			return "404";
		}

		public static function executeRoute() {

			// De acordo com a rota acessada, pegar a controller e action correspondente
			$route = self::checkRoute();

			require_once PATH_PROJECT . $route->getController();
			$controllerAux = str_replace(".php", "", $route->getController());
			$controllerAux = str_replace("Controllers/", "", $controllerAux);
			$controller = new $controllerAux;

			// verificação se action existe na controller, se existindo executa
			if(method_exists($controller, $route->getAction())) {
				$action = $route->getAction();
				$controller->$action();
			} else {
				// caso contrário redirectiona para página não encontrada
				die("400 ---- action nao ecnontrado");
				return "400";
			}
		}
	}
?>