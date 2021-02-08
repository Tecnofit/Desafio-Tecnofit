<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\StudentTrainingProgress;

use Throwable;
use Ramsey\Uuid\Uuid;
use App\Modules\Gym\Application\Exception\Activity\ActivityNotFoundException;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingNotFoundException;
use App\Modules\Gym\Application\Exception\StudentTrainingProgress\StudentTrainingProgressBadRequestException;
use App\Modules\Gym\Application\Exception\StudentTrainingProgress\StudentTrainingProgressChangeStatusSuccessfullyException;
use App\Modules\Gym\Application\Exception\StudentTrainingProgress\StudentTrainingProgressNotChangeStatusException;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Domain\Repository\ActivityRepository;
use App\Modules\Gym\Domain\Repository\StudentTrainingProgressRepository;
use App\Modules\Gym\Domain\Repository\StudentTrainingRepository;

/**
 * Class StudentTrainingProgressChangeStatusHandler
 * @package App\Modules\Gym\Handler\StudentTrainingProgress
 */
class StudentTrainingProgressChangeStatusHandler extends Handler
{
    /**
     * @param Request $request
     * @param array|null $uriParams
     * @return Response
     * @throws ActivityNotFoundException
     * @throws StudentTrainingNotFoundException
     * @throws StudentTrainingProgressBadRequestException
     * @throws StudentTrainingProgressChangeStatusSuccessfullyException
     * @throws StudentTrainingProgressNotChangeStatusException
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $params = $request->getBody();

            $studentTrainingUuid = Uuid::fromString($uriParams['student_training_uuid']);

            $activityUuid = Uuid::fromString($uriParams['activity_uuid']);

            $status = $params['status'];

            $studentTraining = StudentTrainingRepository::getByUuid($studentTrainingUuid);

            $activity = ActivityRepository::getByUuid($activityUuid);

            StudentTrainingProgressRepository::changeStatus($studentTraining['id'], $activity['id'], $status);

            throw new StudentTrainingProgressChangeStatusSuccessfullyException;

        } catch (StudentTrainingNotFoundException $e) {
            throw $e;
        } catch (ActivityNotFoundException $e) {
            throw $e;
        } catch (StudentTrainingProgressNotChangeStatusException $e) {
            throw $e;
        } catch (StudentTrainingProgressChangeStatusSuccessfullyException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new StudentTrainingProgressBadRequestException;
        }
    }
}
