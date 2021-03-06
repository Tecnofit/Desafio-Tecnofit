<?php

namespace Shared\Domain\Value;

use Shared\Infrastructure\Exception\DataValidateException;

final class UsuarioPerfilValue
{
    private String $value;

    private $options = [
        "aluno" => "Aluno",
        "admin" => "Administrador",
    ];

    public function __construct(String $value)
    {
        $this->value = $value;

        if (!isset($this->options[$this->value])) {
            throw new DataValidateException("Perfil inválido");
        }
    }

    function getValue(): String
    {
        return $this->value;
    }

    function getDescricao(): String
    {
        return $this->options[$this->value];
    }
}
