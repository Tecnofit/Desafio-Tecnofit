<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Student;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\View\StudentTraining\StudentTrainingByUserView;
use App\Modules\Gym\Domain\Repository\StudentTrainingRepository;
use App\Modules\Gym\Domain\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Throwable;

/**
 * Class StudentSearchActivitiesHandler
 * @package App\Modules\Gym\Handler\Student
 */
class StudentSearchActivitiesHandler extends Handler
{
    /**
     * @param Request $request
     * @param array|null $uriParams
     * @return Response
     * @throws Throwable
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $uuid = Uuid::fromString($uriParams['uuid']);

            $studentTrainingUuid = Uuid::fromString($uriParams['student_training_uuid']);

            $user = UserRepository::getByUuId($uuid);

            $activities = StudentTrainingRepository::getActivitiesByTraining(
                $user['id'],
                $studentTrainingUuid
            );

            $activitiesByUser = new StudentTrainingByUserView($activities);

            return Response::json($activitiesByUser);

        } catch (Throwable $e) {
            throw $e;
        }
    }
}
