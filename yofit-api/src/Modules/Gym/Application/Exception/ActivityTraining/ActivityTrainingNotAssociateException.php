<?php

namespace App\Modules\Gym\Application\Exception\ActivityTraining;

use Exception;

/**
 * Class ActivityTrainingNotAssociateException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityTrainingNotAssociateException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_training_not_associated", 422);
    }
}
