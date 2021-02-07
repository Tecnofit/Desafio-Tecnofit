<?php

namespace App\Modules\Gym\Application\Exception\Activity;

use Exception;

/**
 * Class ActivityCreateBadRequestException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityCreateBadRequestException extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_create_bad_request", 400);
    }
}
