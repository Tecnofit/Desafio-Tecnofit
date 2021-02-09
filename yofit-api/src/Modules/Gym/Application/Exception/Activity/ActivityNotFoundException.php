<?php

namespace App\Modules\Gym\Application\Exception\Activity;

use Exception;

/**
 * Class ActivityNotFoundException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_not_found", 204);
    }
}
