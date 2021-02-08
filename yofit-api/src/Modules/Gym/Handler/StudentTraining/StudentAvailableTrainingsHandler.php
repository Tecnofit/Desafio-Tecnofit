<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\StudentTraining;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\View\StudentTraining\StudentTrainingByUserView;
use App\Modules\Gym\Domain\Repository\StudentTrainingRepository;
use App\Modules\Gym\Domain\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Throwable;

/**
 * Class StudentAvailableTrainingsHandler
 * @package App\Modules\Gym\Handler\Student
 */
class StudentAvailableTrainingsHandler extends Handler
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

            $user = UserRepository::getByUuId($uuid);

            $trainings = StudentTrainingRepository::getAvailableTrainings($user['id']);

            $trainingsByUser = new StudentTrainingByUserView($trainings);

            return Response::json($trainingsByUser);

        } catch (Throwable $e) {
            throw $e;
        }
    }
}
