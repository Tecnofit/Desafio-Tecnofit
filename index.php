<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

define("PATH_PROJECT", __DIR__ . "/");
define("BASE_PROJECT", "/" . basename(PATH_PROJECT) . "/");


// iniciar a sessão
session_start();
if(isset($_SESSION["user"])) {
	// verificação usuario logado
}
// $_SESSION["user"] = null;
// echo "<pre>";

// Mapear configurações
require_once PATH_PROJECT . "Helpers/Configs.php";
Configs::mapConfigs();

// Mapear roteamento
require_once PATH_PROJECT . "Services/Routes.php";
// $route = new Routes();
Routes::mapRoutes();
Routes::executeRoute();

?>