<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

/**
 * Class Handler
 *
 * @package App\Infrastructure
 */
abstract class Handler
{
    public abstract function handle(Request $request, ?array $uriParams): Response;
}
