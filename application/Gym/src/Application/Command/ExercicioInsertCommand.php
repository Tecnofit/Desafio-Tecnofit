<?php

namespace Gym\Application\Command;

use Gym\Domain\Entity\ExercicioEntity;
use Gym\Infrastructure\Repository\ExercicioRepository;

final class ExercicioInsertCommand
{
    private ExercicioRepository $exercicioRepository;

    public function __construct(
        ExercicioRepository $exercicioRepository
    ) {
        $this->exercicioRepository = $exercicioRepository;
    }

    public function run (ExercicioEntity $exercicio): ExercicioEntity
    {
        return $this->exercicioRepository->insertExercicio($exercicio);
    }
}