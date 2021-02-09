<?php

namespace App\Modules\Gym\Application\Exception\Activity;

use Exception;

/**
 * Class ActivityParameterWrongException
 * @package App\Modules\Gym\Application\Exception
 */
class ActivityParameterWrongException extends Exception
{
    public function __construct(string $parameter)
    {
        parent::__construct("activity_parameter_wrong." . $parameter, 400);
    }
}
