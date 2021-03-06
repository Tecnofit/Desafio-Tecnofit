<?php

namespace Gym\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

final class TreinoEntity
{
    private ?UuidInterface $id;
    private String $nome;
    private String $descricao;
    private TreinoExercicioCollection $exercicios;

    public function __construct(
        ?UuidInterface $id,
        String $nome,
        String $descricao,
        TreinoExercicioCollection $exercicios
    ) {
        $this->id = $id;
        $this->nome = trim($nome);
        $this->descricao = $descricao;
        $this->exercicios = $exercicios;
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

    public function getExercicios (): TreinoExercicioCollection
    {
        return $this->exercicios;
    }

    public function setId (UuidInterface $id)
    {
        $this->id = $id;
    }
}