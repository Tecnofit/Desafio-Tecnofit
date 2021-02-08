<?php

namespace App\Modules\Gym\Application\Exception\User;

use Exception;

/**
 * Class UserNotRemovedException
 * @package App\Modules\Gym\Application\Exception
 */
class UserNotRemovedException extends Exception
{
    public function __construct()
    {
        parent::__construct("user_not_removed", 422);
    }
}
