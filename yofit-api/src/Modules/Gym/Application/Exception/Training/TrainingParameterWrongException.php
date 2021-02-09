<?php

namespace App\Modules\Gym\Application\Exception\Training;

use Exception;

/**
 * Class TrainingParameterWrongException
 * @package App\Modules\Gym\Application\Exception
 */
class TrainingParameterWrongException extends Exception
{
    public function __construct(string $parameter)
    {
        parent::__construct("training_parameter_wrong." . $parameter, 400);
    }
}
