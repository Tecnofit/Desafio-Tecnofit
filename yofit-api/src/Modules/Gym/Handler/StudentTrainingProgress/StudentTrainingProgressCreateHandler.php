<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\StudentTrainingProgress;

use App\Modules\Gym\Application\Exception\Activity\ActivityNotFoundException;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingNotFoundException;
use App\Modules\Gym\Application\Exception\StudentTrainingProgress\StudentTrainingProgressNotSavedException;
use Throwable;
use Ramsey\Uuid\Uuid;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\Exception\StudentTrainingProgress\StudentTrainingProgressCreateSuccessfullyException;
use App\Modules\Gym\Application\Exception\Training\TrainingCreateBadRequestException;
use App\Modules\Gym\Application\View\StudentTrainingProgressView;
use App\Modules\Gym\Domain\Repository\ActivityRepository;
use App\Modules\Gym\Domain\Repository\StudentTrainingProgressRepository;
use App\Modules\Gym\Domain\Repository\StudentTrainingRepository;

/**
 * Class StudentTrainingProgressCreateHandler
 * @package App\Modules\Gym\Handler\StudentTrainingProgress
 */
class StudentTrainingProgressCreateHandler extends Handler
{
    /**
     * @param Request $request
     * @param array|null $uriParams
     * @return Response
     * @throws ActivityNotFoundException
     * @throws StudentTrainingNotFoundException
     * @throws StudentTrainingProgressCreateSuccessfullyException
     * @throws StudentTrainingProgressNotSavedException
     * @throws TrainingCreateBadRequestException
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $params = $request->getBody();

            $studentTrainingUuid = Uuid::fromString($params['student_training_uuid']);

            $activityUuid = Uuid::fromString($params['activity_uuid']);

            $status = $params['status'];

            $studentTraining = StudentTrainingRepository::getByUuid($studentTrainingUuid);

            $activity = ActivityRepository::getByUuid($activityUuid);

            $studentTrainingProgressView = new StudentTrainingProgressView(
                $studentTraining['id'],
                $activity['id'],
                $status
            );

            StudentTrainingProgressRepository::create($studentTrainingProgressView);

            throw new StudentTrainingProgressCreateSuccessfullyException;

        } catch (StudentTrainingNotFoundException $e) {
            throw $e;
        } catch (ActivityNotFoundException $e) {
            throw $e;
        } catch (StudentTrainingProgressNotSavedException $e) {
            throw $e;
        } catch (StudentTrainingProgressCreateSuccessfullyException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new TrainingCreateBadRequestException;
        }
    }
}
