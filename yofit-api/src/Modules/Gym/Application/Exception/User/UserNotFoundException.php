<?php

namespace App\Modules\Gym\Application\Exception\User;

use Exception;

/**
 * Class UserNotFoundException
 * @package App\Modules\Gym\Application\Exception
 */
class UserNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("user_not_found", 204);
    }
}
