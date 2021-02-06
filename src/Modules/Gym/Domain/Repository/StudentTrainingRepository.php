<?php

namespace App\Modules\Gym\Domain\Repository;

use App\Modules\Gym\Application\Enum\StudentTrainingEnum;
use App\Modules\Gym\Application\Enum\TrainingEnum;
use Throwable;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Database\Capsule\Manager as DB;
use App\Infrastructure\Contracts\ViewInterface;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingNotAssociateException;
use App\Modules\Gym\Domain\Entity\StudentTraining;

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
     */
    public static function getTrainingsByUserId(int $userId): array
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
            // TODO:
        }
    }

    /**
     * @param int $userId
     * @param UuidInterface $uuid
     * @return array
     */
    public static function getActivitiesByTraining(int $userId, UuidInterface $uuid): array
    {
        try {
            return StudentTraining::select(
                DB::raw("
                  activity.uuid                    AS activity_uuid,
                  activity.name                    AS activity_name,
                  student_training_progress.status AS student_training_progress_status,
                  activity_training.sections       AS activity_training_sections
                "))
                ->join(
                    DB::raw('activity_training FORCE INDEX (IDX_activity_training_training_id)'),
                    'activity_training.training_id', '=', 'student_training.training_id'
                )
                ->join('training', 'training.id', '=', 'student_training.training_id')
                ->join('activity', 'activity.id', '=', 'activity_training.activity_id')
                ->leftJoin('student_training_progress', function ($join) {
                    $join->on('student_training_progress.student_training_id', '=', 'student_training.id');
                    $join->on('student_training_progress.activity_id', '=', 'activity.id');
                })
                ->where('student_training.user_id', $userId)
                ->where('student_training.uuid', $uuid->toString())
                ->where('student_training.status', StudentTrainingEnum::$STATUS_ENABLED)
                ->where('training.status', TrainingEnum::$STATUS_ENABLED)
                ->orderBy('activity.name', 'ASC')
                ->get()
                ->toArray();

        } catch (Throwable $e) {
            // TODO:
        }
    }

    /**
     * @param ViewInterface $view
     * @throws StudentTrainingNotAssociateException
     */
    public static function associate(ViewInterface $view): void
    {
        try {
            $params = $view->serialize();

            if (empty($params['id'])) {
                unset($params['id']);
            }

            StudentTraining::insert($params);

        } catch (Throwable $e) {
            throw new StudentTrainingNotAssociateException;
        }
    }

    /**
     * @param int $userId
     * @throws StudentTrainingNotAssociateException
     */
    public static function disableAllByUserId(int $userId): void
    {
        try {
            StudentTraining::where('user_id', $userId)->update(['status' => StudentTrainingEnum::$STATUS_DISABLED]);
        } catch (Throwable $e) {
            throw new StudentTrainingNotAssociateException;
        }
    }
}
