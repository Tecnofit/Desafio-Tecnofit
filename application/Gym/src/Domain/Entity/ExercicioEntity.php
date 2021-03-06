<?php

namespace Gym\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

final class ExercicioEntity
{
    private ?UuidInterface $id;
    private String $nome;
    private String $descricao;

    public function __construct(
        ?UuidInterface $id,
        String $nome,
        String $descricao
    ) {
        $this->id = $id;
        $this->nome = trim($nome);
        $this->descricao = $descricao;
    }

    public function getId (): ?UuidInterface
    {
        return $this->id;
    }

    public function getNome (): String
    {
        return $this->nome;
    }

    public function getDescricao (): String
    {
        return $this->descricao;
    }

    public function setId (UuidInterface $id)
    {
        $this->id = $id;
    }
}