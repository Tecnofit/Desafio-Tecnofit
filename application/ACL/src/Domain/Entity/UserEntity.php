<?php

namespace ACL\Domain\Entity;

use Ramsey\Uuid\UuidInterface;
use Shared\Domain\Value\EmailValue;
use Shared\Domain\Value\SenhaValue;
use Shared\Domain\Value\UsuarioPerfilValue;

final class UserEntity
{
    private ?UuidInterface $id;
    private String $nome;
    private EmailValue $email;
    private SenhaValue $senha;
    private UsuarioPerfilValue $perfil;

    public function __construct(
        ?UuidInterface $id,
        String $nome,
        EmailValue $email,
        SenhaValue $senha,
        UsuarioPerfilValue $perfil
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->perfil = $perfil;
    }

    public function getId (): ?UuidInterface
    {
        return $this->id;
    }

    public function getNome (): String
    {
        return $this->nome;
    }

    public function getEmail (): EmailValue
    {
        return $this->email;
    }

    public function getSenha (): SenhaValue
    {
        return $this->senha;
    }

    public function getPerfil (): UsuarioPerfilValue
    {
        return $this->perfil;
    }

    public function setId (UuidInterface $id)
    {
        $this->id = $id;
    }
}