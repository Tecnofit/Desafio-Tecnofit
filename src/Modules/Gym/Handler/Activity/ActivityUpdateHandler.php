<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Activity;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\Exception\Activity\ActivityNotSavedException;
use App\Modules\Gym\Application\Exception\Activity\ActivityParameterWrongException;
use App\Modules\Gym\Application\Exception\Activity\ActivityUpdateBadRequest;
use App\Modules\Gym\Application\View\ActivityView;
use App\Modules\Gym\Domain\Repository\ActivityRepository;
use Exception;
use Ramsey\Uuid\Uuid;
use Throwable;

/**
 * Class ActivityUpdateHandler
 * @package App\Modules\Gym\Handler\Activity
 */
class ActivityUpdateHandler extends Handler
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
        try {
            $params = $request->getBody();

            $this->validate($params);

            $uuid = Uuid::fromString($params['uuid']);

            $activity = ActivityRepository::getByUuId($uuid);

            $activityView = new ActivityView($activity["id"], $uuid, $params['name']);

            ActivityRepository::save($activityView);

            return Response::json($activityView);

        } catch (ActivityParameterWrongException $e) {
            throw $e;
        } catch (ActivityNotSavedException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new ActivityUpdateBadRequest;
        }
    }

    /**
     * @param array $params
     * @throws ActivityParameterWrongException
     */
    private function validate(array $params)
    {
        if (!array_key_exists('uuid', $params)) {
            throw new ActivityParameterWrongException("uuid");
        }

        if (!array_key_exists('name', $params)) {
            throw new ActivityParameterWrongException("name");
        }
    }
}
