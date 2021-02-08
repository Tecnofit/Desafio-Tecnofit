<?php

namespace App\Modules\Gym\Application\Exception\Activity;

use Exception;

/**
 * Class ActivityWithActiveTrainingException
 * @package App\Modules\Gym\Application\Exception\Activity
 */
class ActivityWithActiveTrainingException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_with_active_training", 422);
    }
}
