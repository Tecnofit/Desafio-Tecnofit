<?php

namespace App\Modules\Gym\Application\Exception\ActivityTraining;

use Exception;

/**
 * Class ActivityTrainingAlreadyAssociateException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityTrainingAlreadyAssociateException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_training_already_associated", 422);
    }
}
