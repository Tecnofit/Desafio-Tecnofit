<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Activity;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\Exception\Activity\ActivityNotFoundException;
use App\Modules\Gym\Application\View\ActivityView;
use App\Modules\Gym\Domain\Repository\ActivityRepository;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Throwable;

/**
 * Class ActivityDetailHandler
 * @package App\Modules\Gym\Handler\Activity
 */
class ActivityDetailHandler extends Handler
{
    /**
     * @param Request $request
     *
     * @param array $uriParams
     *
     * @return Response
     * @throws Throwable
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $uuid = Uuid::fromString($uriParams['uuid']);

            $activity = ActivityRepository::getByUuId($uuid);

            $activityView = new ActivityView(0, $uuid, $activity['name']);

            return Response::json($activityView);

        } catch (InvalidUuidStringException $e) {
            throw new ActivityNotFoundException;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
