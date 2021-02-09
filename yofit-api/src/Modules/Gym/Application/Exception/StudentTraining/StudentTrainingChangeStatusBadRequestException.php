<?php

namespace App\Modules\Gym\Application\Exception\StudentTraining;

use Exception;

/**
 * Class StudentTrainingChangeStatusBadRequestException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingChangeStatusBadRequestException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_change_status_bad_request", 400);
    }
}
