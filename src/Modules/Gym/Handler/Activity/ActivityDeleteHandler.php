<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Activity;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use Exception;

/**
 * Class ActivityDeleteHandler
 * @package App\Modules\Gym\Handler\Activity
 */
class ActivityDeleteHandler extends Handler
{
    /**
     * @param Request $request
     *
     * @param array $uriParams
     *
     * @return Response
     * @throws Exception
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        // TODO:
    }
}
