<?php

namespace App\Modules\Gym\Domain\Repository;

use App\Modules\Gym\Application\Contract\ActivityRepositoryInterface;
use App\Modules\Gym\Application\Enum\ActivityTrainingEnum;
use App\Modules\Gym\Application\Exception\ActivityTraining\ActivityTrainingAllLinkNotRemovedException;
use App\Modules\Gym\Application\Exception\ActivityTraining\ActivityTrainingAlreadyAssociateException;
use App\Modules\Gym\Application\Exception\ActivityTraining\ActivityTrainingNotAssociateException;
use App\Modules\Gym\Application\View\ActivityTrainingView;
use App\Modules\Gym\Domain\Entity\ActivityTraining;
use App\Modules\Gym\Domain\Entity\Training;
use Throwable;

/**
 * Class ActivityTrainingRepository
 *
 * @package App\Modules\Gym\Domain\Repository
 */
abstract class ActivityTrainingRepository implements ActivityRepositoryInterface
{
    /**
     * @param ActivityTrainingView $activityTrainingView
     * @throws ActivityTrainingAlreadyAssociateException
     * @throws ActivityTrainingNotAssociateException
     */
    public static function associate(ActivityTrainingView $activityTrainingView): void
    {
        try {
            if (self::isAssociated(
                $activityTrainingView->getActivityId(),
                $activityTrainingView->getTrainingId())) {

                throw new ActivityTrainingAlreadyAssociateException;
            }

            ActivityTraining::insert($activityTrainingView->serialize());
        } catch (ActivityTrainingAlreadyAssociateException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new ActivityTrainingNotAssociateException;
        }
    }

    /**
     * @param int $activityId
     * @param int $trainingId
     * @return bool
     */
    public static function isAssociated(int $activityId, int $trainingId): bool
    {
        return ActivityTraining::where('activity_id', $activityId)
            ->where('training_id', $trainingId)
            ->count();
    }

    /**
     * @param int $activityId
     * @return int
     */
    public static function countTrainingsLinkedByActivity(int $activityId): int
    {
        return Training::join('activity_training', 'activity_training.training_id', '=', 'training.id')
            ->where('activity_training.activity_id', $activityId)
            ->where('training.status', ActivityTrainingEnum::$STATUS_ENABLED)
            ->count();
    }

    /**
     * @param int $activityId
     * @throws ActivityTrainingAllLinkNotRemovedException
     */
    public static function removeByActivityId(int $activityId): void
    {
        try {
            ActivityTraining::where('activity_id', $activityId)->delete();
        } catch (Throwable $e) {
            throw new ActivityTrainingAllLinkNotRemovedException;
        }
    }
}
