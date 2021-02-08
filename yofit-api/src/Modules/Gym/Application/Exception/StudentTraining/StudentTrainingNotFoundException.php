<?php

namespace App\Modules\Gym\Application\Exception\StudentTraining;

use Exception;

/**
 * Class StudentTrainingNotFoundException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_not_found", 204);
    }
}
