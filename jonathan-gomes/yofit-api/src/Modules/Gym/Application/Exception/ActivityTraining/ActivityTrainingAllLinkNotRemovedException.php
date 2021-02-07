<?php

namespace App\Modules\Gym\Application\Exception\ActivityTraining;

use Exception;

/**
 * Class ActivityTrainingAllLinkNotRemovedException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityTrainingAllLinkNotRemovedException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_training_all_link_not_removed", 422);
    }
}
