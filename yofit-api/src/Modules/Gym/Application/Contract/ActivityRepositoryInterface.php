<?php

namespace App\Modules\Gym\Application\Contract;

use App\Infrastructure\Contracts\RepositoryInterface;
use App\Modules\Gym\Application\View\ActivityTrainingView;

/**
 * Interface ActivityRepositoryInterface
 * @package App\Modules\Gym\Application\Contract
 */
interface ActivityRepositoryInterface extends RepositoryInterface
{
    public static function associate(ActivityTrainingView $activityTrainingView): void;

    public static function countTrainingsLinkedByActivity(int $activityId): int;

    public static function removeByActivityId(int $activityId): void;
}
