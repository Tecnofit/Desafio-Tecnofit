<?php

namespace App\Modules\Gym\Application\Exception\Training;

use Exception;

/**
 * Class TrainingCreateBadRequestException
 * @package App\Modules\Gym\Application\Exception
 */
class TrainingCreateBadRequestException extends Exception
{
    public function __construct()
    {
        parent::__construct("training_create_bad_request", 400);
    }
}
