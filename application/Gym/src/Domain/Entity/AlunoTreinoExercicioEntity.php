<?php

namespace Gym\Domain\Entity;

use Ramsey\Uuid\UuidInterface;

final class AlunoTreinoExercicioEntity
{
    private UuidInterface $id;
    private UuidInterface $treinoExercicioId;
    private UuidInterface $exercicioId;
    private ?bool $executed;

    public function __construct(
        UuidInterface $id,
        UuidInterface $treinoExercicioId,
        UuidInterface $exercicioId,
        ?bool $executed
    ) {
        $this->id = $id;
        $this->treinoExercicioId = $treinoExercicioId;
        $this->exercicioId = $exercicioId;
        $this->executed = $executed;
    }

    public function getId() :UuidInterface
    {
        return $this->id;
    }

    public function getTreinoExercicioId() :UuidInterface
    {
        return $this->treinoExercicioId;
    }

    public function getExercicioId() :UuidInterface
    {
        return $this->exercicioId;
    }

    public function getExecuted() :?bool
    {
        return $this->executed;
    }

    public function setExecuted(bool $executed) :void
    {
        $this->executed = $executed;
    }
}