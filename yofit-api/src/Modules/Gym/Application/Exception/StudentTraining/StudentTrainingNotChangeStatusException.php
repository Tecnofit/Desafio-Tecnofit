<?php

namespace App\Modules\Gym\Application\Exception\StudentTraining;

use Exception;

/**
 * Class StudentTrainingNotChangeStatusException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingNotChangeStatusException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_not_change_status", 422);
    }
}
