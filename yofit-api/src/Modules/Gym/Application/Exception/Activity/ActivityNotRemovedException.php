<?php

namespace App\Modules\Gym\Application\Exception\Activity;

use Exception;

/**
 * Class ActivityNotRemovedException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityNotRemovedException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_not_removed", 422);
    }
}
