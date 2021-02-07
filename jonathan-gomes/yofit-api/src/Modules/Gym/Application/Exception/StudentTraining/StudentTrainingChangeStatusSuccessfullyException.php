<?php

namespace App\Modules\Gym\Application\Exception\StudentTraining;

use Exception;

/**
 * Class StudentTrainingChangeStatusSuccessfullyException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingChangeStatusSuccessfullyException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_change_status_successfully", 200);
    }
}
