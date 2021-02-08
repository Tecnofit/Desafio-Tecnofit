<?php

namespace App\Modules\Gym\Application\Exception\StudentTrainingProgress;

use Exception;

/**
 * Class StudentTrainingProgressNotSavedException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingProgressNotSavedException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_progress_not_saved", 422);
    }
}
