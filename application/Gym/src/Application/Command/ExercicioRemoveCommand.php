<?php

namespace Gym\Application\Command;

use Gym\Domain\Entity\TreinoEntity;
use Gym\Infrastructure\Repository\ExercicioRepository;
use Gym\Infrastructure\Repository\TreinoRepository;
use Ramsey\Uuid\UuidInterface;
use Shared\Infrastructure\Exception\DataValidateException;

final class ExercicioRemoveCommand
{
    private ExercicioRepository $exercicioRepository;
    private TreinoRepository $treinoRepository;

    public function __construct(
        ExercicioRepository $exercicioRepository,
        TreinoRepository $treinoRepository
    ) {
        $this->exercicioRepository = $exercicioRepository;
        $this->treinoRepository = $treinoRepository;
    }

    public function run (UuidInterface $exercicioId): bool
    {
        $existent = $this->exercicioRepository->findExercicios($exercicioId)->get(0);

        if (!$existent) {
            return true;
        }

        $treinosUsando = $this->treinoRepository->findTreinos(null, $exercicioId);

        if ($treinosUsando->size() > 0) {
            throw new DataValidateException(
                "O exercício está sendo utilizados nos treinos: " . implode(", ", array_map(function(TreinoEntity $treino) {
                    return $treino->getNome();
                }, $treinosUsando->getList()))
            );
        }

        return $this->exercicioRepository->remove($exercicioId);
    }
}