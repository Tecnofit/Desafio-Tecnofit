<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Activity;

use App\Modules\Gym\Application\Exception\Activity\ActivityRemovedSuccessfullyException;
use Exception;
use Ramsey\Uuid\Uuid;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Domain\Repository\ActivityRepository;

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
        $uuid = Uuid::fromString($uriParams['uuid']);

        $activity = ActivityRepository::getByUuId($uuid);

        ActivityRepository::remove($activity['id']);

        throw new ActivityRemovedSuccessfullyException;
    }
}
