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
        header("Access-Control-Allow-Origin: {$_ENV['CORS_ORIGIN']}");
    }
}
