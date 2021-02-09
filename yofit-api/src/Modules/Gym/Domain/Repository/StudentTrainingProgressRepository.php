<?php

namespace App\Modules\Gym\Domain\Repository;

use Throwable;
use App\Modules\Gym\Application\Exception\StudentTrainingProgress\StudentTrainingProgressNotChangeStatusException;
use App\Modules\Gym\Application\Exception\StudentTrainingProgress\StudentTrainingProgressNotSavedException;
use App\Modules\Gym\Domain\Entity\StudentTrainingProgress;
use App\Infrastructure\Contracts\ViewInterface;

/**
 * Class StudentTrainingProgressRepository
 *
 * @package App\Modules\Gym\Domain\Repository
 */
abstract class StudentTrainingProgressRepository
{
    /**
     * @param ViewInterface $view
     * @throws StudentTrainingProgressNotSavedException
     */
    public static function create(ViewInterface $view): void
    {
        try {
            StudentTrainingProgress::insert($view->serialize());
        } catch (Throwable $e) {
            throw new StudentTrainingProgressNotSavedException;
        }
    }

    /**
     * @param int $studentTrainingId
     * @param int $activityId
     * @param string $status
     * @throws StudentTrainingProgressNotChangeStatusException
     */
    public static function changeStatus(int $studentTrainingId, int $activityId, string $status): void
    {
        try {
            StudentTrainingProgress::where('student_training_id', $studentTrainingId)
                ->where('activity_id', $activityId)
                ->update(['status' => $status]);

        } catch (Throwable $e) {
            throw new StudentTrainingProgressNotChangeStatusException;
        }
    }
}
