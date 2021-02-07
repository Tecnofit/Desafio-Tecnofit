<?php

namespace App\Infrastructure\Middleware;

use App\Infrastructure\Http\Request;
use Exception;

/**
 * Class Cors
 *
 * @package App\Infrastructure\Middleware
 */
abstract class CorsMiddleware
{
    /**
     * @param Request $request
     *
     * @throws Exception
     */
    public static function validate(Request $request): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: token, Content-Type');
            header('Access-Control-Max-Age: 1728000');
            header('Content-Length: 0');
            header('Content-Type: text/plain');
            die();
        }

        header("Access-Control-Allow-Origin: {$_ENV['CORS_ORIGIN']}");
        header('Content-Type: application/json');
    }
}
