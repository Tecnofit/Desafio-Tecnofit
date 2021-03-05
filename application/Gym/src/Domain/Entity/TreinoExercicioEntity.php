<?php

namespace Gym\Domain\Entity;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class TreinoExercicioEntity
{
    private ?UuidInterface $id;
    private UuidInterface $exercicioId;
    private Int $repeticoes;

    public function __construct(
        ?UuidInterface $id,
        UuidInterface $exercicioId,
        Int $repeticoes
    ) {
        $this->id = $id ?? Uuid::uuid4();
        $this->exercicioId = $exercicioId;
        $this->repeticoes = $repeticoes;
    }

    public function getId (): ?UuidInterface
    {
        return $this->id;
    }

    public function getExercicioId (): UuidInterface
    {
        return $this->exercicioId;
    }

    public function getRepeticoes (): Int
    {
        return $this->repeticoes;
    }
}