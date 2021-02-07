<?php

namespace App\Modules\Gym\Application\Exception\User;

use Exception;

/**
 * Class UserNotSavedException
 * @package App\Modules\Gym\Application\Exception
 */
class UserNotSavedException extends Exception
{
    public function __construct()
    {
        parent::__construct("user_not_saved", 422);
    }
}
