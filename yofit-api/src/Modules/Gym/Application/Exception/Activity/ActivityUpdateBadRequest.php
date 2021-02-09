<?php

namespace App\Modules\Gym\Application\Exception\Activity;

use Exception;

/**
 * Class ActivityUpdateBadRequest
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityUpdateBadRequest extends Exception
{
    public function __construct()
    {
        parent::__construct("activity_update_bad_request", 400);
    }
}
