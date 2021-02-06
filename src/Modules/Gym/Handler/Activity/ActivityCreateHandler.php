<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Activity;

use Exception;
use Throwable;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\Exception\Activity\ActivityCreateBadRequest;
use App\Modules\Gym\Application\Exception\Activity\ActivityNotSavedException;
use App\Modules\Gym\Application\Exception\Activity\ActivityParameterWrongException;
use App\Modules\Gym\Application\View\ActivityView;
use App\Modules\Gym\Domain\Repository\ActivityRepository;

/**
 * Class ActivityCreateHandler
 * @package App\Modules\Gym\Handler\Activity
 */
class ActivityCreateHandler extends Handler
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

            $activityView = new ActivityView(0, $request->getUuid(), $params['name']);

            $activityId = ActivityRepository::save($activityView);

            $activityView->setId(intval($activityId));

            return Response::json($activityView);

        } catch (ActivityParameterWrongException $e) {
            throw $e;
        } catch (ActivityNotSavedException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new ActivityCreateBadRequest;
        }
    }

    /**
     * @param array $params
     * @throws ActivityParameterWrongException
     */
    private function validate(array $params)
    {
        if (!array_key_exists('name', $params)) {
            throw new ActivityParameterWrongException("name");
        }
    }
}
