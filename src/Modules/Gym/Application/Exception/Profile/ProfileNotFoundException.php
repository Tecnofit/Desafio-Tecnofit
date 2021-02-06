<?php

namespace App\Modules\Gym\Application\Exception\Profile;

use Exception;

/**
 * Class ProfileNotFoundException
 * @package App\Modules\Gym\Application\Exception
 */
class ProfileNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("profile_not_found", 204);
    }
}
