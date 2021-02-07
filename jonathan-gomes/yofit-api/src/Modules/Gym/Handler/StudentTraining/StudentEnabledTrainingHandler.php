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
 * Class StudentEnabledTrainingHandler
 * @package App\Modules\Gym\Handler\Student
 */
class StudentEnabledTrainingHandler extends Handler
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

            $trainings = StudentTrainingRepository::getEnabledTraining($user['id']);

            $viewParams = [
                'student_training_uuid' => null,
                'training_uuid' => null,
                'training_name' => null,
                'activities' => null
            ];

            if (count($trainings) > 0) {
                $training = current($trainings);
                $viewParams['student_training_uuid'] = $training->student_training_uuid;
                $viewParams['training_uuid'] = $training->training_uuid;
                $viewParams['training_name'] = $training->training_name;
                $viewParams['activities'] = array_map(function($training) {
                    return [
                        'activity_uuid' => $training->activity_uuid,
                        'activity_name' => $training->activity_name,
                        'status' => $training->student_training_progress_status
                    ];
                }, $trainings);
            }

            $trainingsByUser = new StudentTrainingByUserView($viewParams);

            return Response::json($trainingsByUser);

        } catch (Throwable $e) {
            throw $e;
        }
    }
}
