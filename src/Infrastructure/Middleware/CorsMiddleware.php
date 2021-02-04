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
        if ($_ENV['APP_ENV'] !== 'production') {
            return;
        }

        $origin = $request->getOrigin();

        preg_match("/({$origin})/i", $_ENV['CORS_ORIGIN'], $origins);

        if (!$origins) {
            throw new Exception('cors_invalid');
        }

        header("Access-Control-Allow-Origin: $origin");
    }
}
