<?php

namespace App\Modules\Gym\Application\Exception\StudentTraining;

use Exception;

/**
 * Class StudentTrainingEnrolledSuccessfullyException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingEnrolledSuccessfullyException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_enrolled_successfully", 200);
    }
}
