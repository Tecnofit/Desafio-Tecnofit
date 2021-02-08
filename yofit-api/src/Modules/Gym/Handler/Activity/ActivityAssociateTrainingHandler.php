<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Activity;

use App\Modules\Gym\Application\Exception\Activity\ActivityTrainingParameterWrongException;
use Ramsey\Uuid\Uuid;
use Exception;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\View\ActivityTrainingView;
use App\Modules\Gym\Domain\Repository\ActivityRepository;
use App\Modules\Gym\Domain\Repository\ActivityTrainingRepository;
use App\Modules\Gym\Domain\Repository\TrainingRepository;

/**
 * Class ActivityAssociateTrainingHandler
 * @package App\Modules\Gym\Handler\Activity
 */
class ActivityAssociateTrainingHandler extends Handler
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
        $activityUuid = Uuid::fromString($uriParams['uuid_activity']);

        $trainingUuid = Uuid::fromString($uriParams['uuid_training']);

        $sections = intval($uriParams['sections']);

        $activity = ActivityRepository::getByUuId($activityUuid);

        $training = TrainingRepository::getByUuId($trainingUuid);

        $activityTrainingView = new ActivityTrainingView($activity['id'], $training['id'], $sections);

        ActivityTrainingRepository::associate($activityTrainingView);

        return Response::json($activityTrainingView);
    }
}
