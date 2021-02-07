<?php

namespace App\Infrastructure\Contracts;

use App\Infrastructure\Http\Response;

/**
 * Interface ViewInterface
 *
 * @package App\Infrastructure\Contracts
 */
interface ResponseInterface
{
    public static function json(ViewInterface $view, int $statusCode = 200): Response;
}
