<?php

namespace App\Modules\Gym\Application\Exception\StudentTrainingProgress;

use Exception;

/**
 * Class StudentTrainingProgressChangeStatusSuccessfullyException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingProgressChangeStatusSuccessfullyException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_progress_change_status_successfully", 200);
    }
}
