<?php

namespace App\Modules\Gym\Application\Exception\StudentTrainingProgress;

use Exception;

/**
 * Class StudentTrainingProgressCreateSuccessfullyException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingProgressCreateSuccessfullyException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_progress_create_successfully", 200);
    }
}
