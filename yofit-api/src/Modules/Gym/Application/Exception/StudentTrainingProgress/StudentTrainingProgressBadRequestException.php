<?php

namespace App\Modules\Gym\Application\Exception\StudentTrainingProgress;

use Exception;

/**
 * Class StudentTrainingProgressBadRequestException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingProgressBadRequestException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_progress_bad_request", 400);
    }
}
