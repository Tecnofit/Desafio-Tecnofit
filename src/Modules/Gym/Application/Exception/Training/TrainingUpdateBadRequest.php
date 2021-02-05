<?php

namespace App\Modules\Gym\Application\Exception\Training;

use Exception;

/**
 * Class TrainingUpdateBadRequest
 * @package App\Modules\Gym\Application\Exception
 */
class TrainingUpdateBadRequest extends Exception
{
    public function __construct()
    {
        parent::__construct("training_update_bad_request", 400);
    }
}
