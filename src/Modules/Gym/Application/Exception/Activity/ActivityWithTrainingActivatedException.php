<?php

namespace App\Modules\Gym\Application\Exception\Activity;

use Exception;

/**
 * Class ActivityWithTraningActivatedException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityWithTraningActivatedException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_with_", 422);
    }
}
