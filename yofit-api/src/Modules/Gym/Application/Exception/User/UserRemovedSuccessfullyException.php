<?php

namespace App\Modules\Gym\Application\Exception\User;

use Exception;

/**
 * Class UserRemovedSuccessfullyException
 * @package App\Modules\Gym\Application\Exception
 */
class UserRemovedSuccessfullyException extends Exception
{
    public function __construct()
    {
        parent::__construct("user_excluded_successfully", 200);
    }
}
