<?php

namespace Shared\Infrastructure\Exception;

use Exception;

class DataValidateException extends Exception
{
    public Array $messages = [];

    public function __construct($message, $code = 0, Exception $previous = null)
    {
        $this->messages[] = (Object) [
            "code" => $code,
            "message" => $message,
        ];
        parent::__construct($message, $code, $previous);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}
