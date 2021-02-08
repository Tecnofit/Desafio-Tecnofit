<?php

namespace App\Modules\Gym\Domain\Repository;

use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingNotChangeStatusException;
use Throwable;
use Ramsey\Uuid\UuidInterface;
use Illuminate\Database\Capsule\Manager as DB;
use App\Infrastructure\Contracts\ViewInterface;
use App\Modules\Gym\Application\Enum\StudentTrainingEnum;
use App\Modules\Gym\Application\Enum\TrainingEnum;
use App\Modules\Gym\Application\Exception\StudentTraining\StudentTrainingNotFoundException;
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
     * @param UuidInterface $uuid
     * @return mixed
     * @throws StudentTrainingNotFoundException
     */
    public static function getByUuId(UuidInterface $uuid)
    {
        try {
            return StudentTraining::where('uuid', $uuid->toString())->firstOrFail()->toArray();
        } catch (Throwable $e) {
            throw new StudentTrainingNotFoundException;
        }
    }

    /**
     * @param int $userId
     * @return array
     */
    public static function getAvailableTrainings(int $userId)
    {
        return DB::select(DB::raw("
          SELECT
              DISTINCT
              t.uuid AS training_uuid,
              t.name AS training_name
          FROM activity_training at
             JOIN training t
                ON t.id = at.training_id
             JOIN activity a
                ON a.id = at.activity_id
             LEFT JOIN student_training st
                ON t.id = st.training_id
          WHERE
              st.id IS NULL AND
              (st.user_id = ? OR st.user_id IS NULL);
        "), [$userId]);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public static function getEnabledTraining(int $userId)
    {
        return DB::select(DB::raw("
          SELECT
              st.uuid AS student_training_uuid,
              t.uuid AS training_uuid,
              t.name AS training_name,
              a.uuid AS activity_uuid,
              a.name AS activity_name,
              stp.status AS student_training_progress_status
          FROM student_training st
              JOIN training t
                ON st.training_id = t.id
              JOIN activity_training at
                ON at.training_id = t.id
              JOIN activity a
                ON a.id = at.activity_id
              LEFT JOIN student_training_progress stp
                ON stp.student_training_id = st.id AND
                   stp.activity_id = a.id
          WHERE
              st.user_id = ? AND 
              st.status = ?
          ORDER BY
            a.name ASC;
        "), [$userId, StudentTrainingEnum::$STATUS_ENABLED]);
    }

    /**
     * @param int $userId
     * @return mixed
     */
    public static function getOtherTrainings(int $userId)
    {
        return DB::select(DB::raw("
          SELECT
              DISTINCT
              st.uuid student_training_uuid,
              t.name training_name
          FROM training t
             JOIN activity_training at
                ON at.training_id = t.id
             JOIN student_training st 
                ON t.id = st.training_id
          WHERE
              st.user_id = ? AND
              st.status != ?
        "), [$userId, StudentTrainingEnum::$STATUS_ENABLED]);
    }

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

    /**
     * @param int $id
     * @param string $status
     * @throws StudentTrainingNotChangeStatusException
     */
    public static function changeStatus(int $id, string $status): void
    {
        try {
            StudentTraining::where('id', $id)->update(['status' => $status]);
        } catch (Throwable $e) {
            throw new StudentTrainingNotChangeStatusException;
        }
    }
}
