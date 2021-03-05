<?php

namespace Gym\Application\Command;

use Gym\Domain\Entity\AlunoTreinoCollection;
use Gym\Domain\Entity\AlunoTreinoEntity;
use Gym\Infrastructure\Repository\AlunoTreinoRepository;
use Ramsey\Uuid\UuidInterface;

final class AlunoTreinoListCommand
{
    private AlunoTreinoRepository $alunoTreinoRepository;

    public function __construct(
        AlunoTreinoRepository $alunoTreinoRepository
    ) {
        $this->alunoTreinoRepository = $alunoTreinoRepository;
    }

    public function run (
        ?UuidInterface $alunoTreinoId,
        ?UuidInterface $usuarioId,
        ?UuidInterface $treinoId
    ): AlunoTreinoCollection {
        return $this->alunoTreinoRepository->find(
            $alunoTreinoId,
            $usuarioId,
            $treinoId
        );
    }
}