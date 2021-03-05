<?php

namespace Gym\Application\Command;

use Gym\Domain\Entity\ExercicioCollection;
use Gym\Infrastructure\Repository\ExercicioRepository;
use Ramsey\Uuid\UuidInterface;

final class ExercicioListCommand
{
    private ExercicioRepository $exercicioRepository;

    public function __construct(
        ExercicioRepository $exercicioRepository
    ) {
        $this->exercicioRepository = $exercicioRepository;
    }

    public function run (
        ?UuidInterface $exercicioId = null
    ): ExercicioCollection {
        return $this->exercicioRepository->findExercicios($exercicioId);
    }
}