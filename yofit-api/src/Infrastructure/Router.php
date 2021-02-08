<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Infrastructure\Middleware\AuthMiddleware;
use App\Infrastructure\Http\Request;
use FastRoute;
use Exception;

/**
 * Class RouterAbstract
 *
 * @package App\Infrastructure\Abstracts
 */
abstract class Router
{
    /**
     * @var string
     */
    public static $IS_PUBLIC = 'IS_PUBLIC';

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public static function dispatcher(Request $request)
    {
        $routeInfo = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) use ($request) {
            (require '../config/routes.php')($r);
        })->dispatch($request->getMethod(), $request->getUri());

        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                throw new Exception('route_not_found', 404);
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                throw new Exception('route_method_not_found', 405);
                break;
            case FastRoute\Dispatcher::FOUND:

                Database::connection();

                $isPrivate = true;

                if (is_string($routeInfo[1])) {
                    $handle = $routeInfo[1];
                } else {
                    $handle = $routeInfo[1][0];
                    $isPrivate = $routeInfo[1][1] !== self::$IS_PUBLIC;
                }

                if ($isPrivate) {
                    AuthMiddleware::validate($request->getToken());
                }

                return (new $handle)->handle($request, $routeInfo[2]);
                break;
        }
    }
}
