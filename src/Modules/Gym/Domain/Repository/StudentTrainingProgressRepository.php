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
     * @param ViewInterface $view
     * @throws StudentTrainingProgressNotChangeStatusException
     */
    public static function changeStatus(ViewInterface $view): void
    {
        try {
            $params = $view->serialize();

            StudentTrainingProgress::where('student_training_id', $params['student_training_id'])
                ->where('activity_id', $params['activity_id'])
                ->update(['status' => $params['status']]);

        } catch (Throwable $e) {
            throw new StudentTrainingProgressNotChangeStatusException;
        }
    }
}
