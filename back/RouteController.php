<?php
namespace Tecno\Back;

use Tecno\Exception\InvalidRouteException;

abstract class RouteController
{
    private $params;
    private $classMethod;

    public function __construct()
    {
        $this->params = [];
        $this->classMethod = $this->isRouteValid(explode('/', $_SERVER['PATH_INFO'])[1]);
        $this->classMethod = explode('@', $this->classMethod);
        $this->buildParams();
    }

    private function isRouteValid($routeToCheck)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $endpoints = array_keys($this->routes[$requestMethod]);

        if (!in_array($routeToCheck, $endpoints)) {
            throw new InvalidRouteException();
        }
        
        return $this->routes[$requestMethod][$routeToCheck];
    }

    private function buildParams()
    {
        $pathInfo = explode('/', $_SERVER['PATH_INFO']);
        // $i = 2: Elimina o primeiro elemento do array que é vazio por conta da primeira '/'
        // e elimina o nome da rota.
        $i = 2;
        while ($i < count($pathInfo)) {
            $this->params[$pathInfo[$i]] = isset($pathInfo[$i+1]) ? $pathInfo[$i+1] : '';
            $i += 2;
        }

        if (!empty($_POST)) {
            $this->params = array_merge($this->params, $_POST);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents("php://input"), $this->params);
        }
    }

    public function params()
    {
        return $this->params;
    }

    public function getClassMethod()
    {
        return $this->classMethod;
    }
}