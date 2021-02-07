<?php

namespace App\Modules\Gym\Application\Exception\StudentTrainingProgress;

use Exception;

/**
 * Class StudentTrainingProgressNotChangeStatusException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingProgressNotChangeStatusException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_progress_not_change_status", 422);
    }
}
