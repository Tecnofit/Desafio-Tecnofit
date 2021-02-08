<?php

namespace App\Modules\Gym\Application\Exception\Training;

use Exception;

/**
 * Class TrainingNotFoundException
 * @package App\Modules\Gym\Application\Exception
 */
class TrainingNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("training_not_found", 204);
    }
}
