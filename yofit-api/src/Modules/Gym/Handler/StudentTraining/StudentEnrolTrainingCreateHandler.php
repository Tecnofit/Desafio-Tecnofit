<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\StudentTraining;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\Enum\StudentTrainingEnum;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingEnrolledSuccessfullyException;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingNotAssociateException;
use App\Modules\Gym\Application\View\StudentTrainingView;
use App\Modules\Gym\Domain\Repository\StudentTrainingRepository;
use App\Modules\Gym\Domain\Repository\TrainingRepository;
use App\Modules\Gym\Domain\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Throwable;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class StudentEnrolTrainingCreateHandler
 * @package App\Modules\Gym\Handler\Student
 */
class StudentEnrolTrainingCreateHandler extends Handler
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
            $params = $request->getBody();

            $userUuid = Uuid::fromString($params['user_uuid']);

            $trainingUuid = Uuid::fromString($params['training_uuid']);

            $status = $params['status'];

            $user = UserRepository::getByUuId($userUuid);

            $training = TrainingRepository::getByUuId($trainingUuid);

            try {
                DB::beginTransaction();

                if ($status === StudentTrainingEnum::$STATUS_ENABLED) {
                    StudentTrainingRepository::disableAllByUserId($user['id']);
                }

                $studentTrainingView = new StudentTrainingView(
                    0,
                    Uuid::uuid4(),
                    $user['id'],
                    $training['id'],
                    $status
                );

                StudentTrainingRepository::associate($studentTrainingView);

                DB::commit();

                throw new StudentTrainingEnrolledSuccessfullyException;

            } catch (StudentTrainingEnrolledSuccessfullyException $e) {
                throw $e;
            } catch (Throwable $e) {
                DB::rollback();

                throw new StudentTrainingNotAssociateException;
            }
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
