<?php

namespace Shared\Domain\Value;

use Shared\Infrastructure\Exception\DataValidateException;

final class SenhaValue
{
    private String $value;

    public function __construct(String $value)
    {
        $this->value = $value;
    }

    public function getValue(): String
    {
        return $this->value;
    }

    public static function generatePassword(String $senhaOriginal): SenhaValue
    {
        if (strlen($senhaOriginal) < 6) {
            throw new DataValidateException("A senha deve ter mais de 6 caracteres");
        }

        return new SenhaValue(md5($senhaOriginal));
    }

    public function compareWithOriginal(String $senhaOriginal): bool
    {
        return $this->value === md5($senhaOriginal);
    }
}
