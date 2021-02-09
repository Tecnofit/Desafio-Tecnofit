<?php

namespace App\Modules\Gym\Application\Exception\Activity;

use Exception;

/**
 * Class ActivityRemovedSuccessfullyException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityRemovedSuccessfullyException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_excluded_successfully", 200);
    }
}
