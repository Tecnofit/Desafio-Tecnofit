<?php

namespace Shared\Domain\Value;

final class JWTValue
{
    private String $value;

    public function __construct(String $value)
    {
        $this->value = $value;

        // if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
        //     throw new DataValidateException("E-mail inválido");
        // }
    }

    function getValue(): String
    {
        return $this->value;
    }
}
