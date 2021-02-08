<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\StudentTraining;

use Illuminate\Database\Capsule\Manager as DB;
use App\Modules\Gym\Application\Enum\StudentTrainingEnum;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingNotChangeStatusException;
use Throwable;
use Ramsey\Uuid\Uuid;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingChangeStatusBadRequestException;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingChangeStatusSuccessfullyException;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingNotFoundException;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Domain\Repository\StudentTrainingRepository;

/**
 * Class StudentTrainingChangeStatusHandler
 * @package App\Modules\Gym\Handler\StudentTraining
 */
class StudentTrainingChangeStatusHandler extends Handler
{
    /**
     * @param Request $request
     * @param array|null $uriParams
     * @return Response
     * @throws StudentTrainingChangeStatusBadRequestException
     * @throws StudentTrainingChangeStatusSuccessfullyException
     * @throws StudentTrainingNotChangeStatusException
     * @throws StudentTrainingNotFoundException
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $params = $request->getBody();

            $studentTrainingUuid = Uuid::fromString($uriParams['uuid']);

            $status = $params['status'];

            $studentTraining = StudentTrainingRepository::getByUuid($studentTrainingUuid);

            try {
                DB::beginTransaction();

                if ($status === StudentTrainingEnum::$STATUS_ENABLED) {
                    StudentTrainingRepository::disableAllByUserId($studentTraining['user_id']);
                }

                StudentTrainingRepository::changeStatus($studentTraining['id'], $status);

                DB::commit();

                throw new StudentTrainingChangeStatusSuccessfullyException;

            } catch (StudentTrainingChangeStatusSuccessfullyException $e) {
                throw $e;
            } catch (Throwable $e) {
                DB::rollback();
                throw new StudentTrainingNotChangeStatusException;
            }
        } catch (StudentTrainingChangeStatusSuccessfullyException $e) {
            throw $e;
        } catch (StudentTrainingNotFoundException $e) {
            throw $e;
        } catch (StudentTrainingNotChangeStatusException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new StudentTrainingChangeStatusBadRequestException;
        }
    }
}
