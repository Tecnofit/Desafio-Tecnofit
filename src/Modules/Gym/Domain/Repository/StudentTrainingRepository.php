<?php

namespace App\Modules\Gym\Domain\Repository;

use Throwable;
use App\Modules\Gym\Domain\Entity\StudentTraining;
use App\Modules\Gym\Application\Exception\User\UserNotFoundException;
use Illuminate\Database\Capsule\Manager as DB;

/**
 * Class StudentTrainingRepository
 *
 * @package App\Modules\Gym\Domain\Repository
 */
abstract class StudentTrainingRepository
{
    /**
     * @param int $userId
     * @return mixed
     * @throws UserNotFoundException
     */
    public static function getTrainingsByUserId(int $userId)
    {
        try {
            return StudentTraining::select(
                DB::raw("
                    student_training.uuid   AS student_training_uuid,
                    student_training.status AS student_training_status,
                    training.name           AS training_name,
                    training.status         AS training_status 
                "))
                ->join('training', 'training.id', '=', 'student_training.training_id')
                ->where('student_training.user_id', $userId)
                ->orderBy('training.name', 'ASC')
                ->get()
                ->toArray();

        } catch (Throwable $e) {
            throw new UserNotFoundException;
        }
    }
}
