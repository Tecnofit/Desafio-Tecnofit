<?php

namespace App\Modules\Gym\Application\Exception\StudentTraining;

use Exception;

/**
 * Class StudentTrainingNotAssociateException
 * @package App\Modules\Gym\Application\Exception
 */
class StudentTrainingNotAssociateException extends Exception
{
    public function __construct()
    {
        parent::__construct("student_training_not_associated", 422);
    }
}
